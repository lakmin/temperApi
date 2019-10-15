<?php 

/*
Temper API for Graphs by Lakmin Gunawardena (https://www.lakmin.online)
*/
class Api{ 

    public function __construct(){
        $group_values = []; 
        $set_values = []; 
        $tags = [];
    }

    //connect csv file and assign to data
    public function csvConnect($csv_c){ 
        if (($h = fopen("{$csv_c}", "r")) !== FALSE){
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {
            
                $line = $data[0];                
                $line_values = explode(";",$line);
                $group_values[] = $line_values; 
            }        
            fclose($h);
            return $group_values;
        }
    }

    //resetting the data array 
    public function data_series($group_values){

        foreach ($group_values as $value) {
           
            $tags = [
                'user_id' => $value[0],
                'created_at' => $value[1],
                'onboarding_perentage' => $value[2],
                'count_applications' => $value[3],
                'count_accepted_applications' => $value[4]
            ];
            $set_values[] = $tags;
        }

        $data_return = $this->trim_array($set_values); 
        
        return $data_return;
    }
    


    public function set_series($dataload){

        $set_values = $this->data_series($dataload);     
        $arr = array();

        foreach ($set_values as $key => $item) {
            $arr[$item['created_at']][$key] = $item['onboarding_perentage'];
        }
        return $arr;
    }
    

    public function group_by_week($dataload){

        print_r($dataload);

        $startDate = \DateTime::createFromFormat('Y-m-d', $item['startdate']);
        $week = intval($startDate->format('W'));
        $day = intval($startDate->format('N'));

        $a = ($day < 6 ) ? $week-1 : $week;
    }

    //To remove the title data from data file    
    private function trim_array($data){

        array_shift($data);
        return $data;
    }

    public function api_load_json_data($dataload){

        if (isset($dataload)) {

            $set_series = $this->set_series($dataload);
            $data_series_add = [];


            // $group_by_week(){
            //     group_by_week
            // }


            foreach ($set_series as $key => $series) {
                $data_set = [];
                
                $data_set['name'] = $key;
                $data_set['data'] = $series;

                array_push($data_series_add, $data_set);
            }

            $data ['series'] = $data_series_add;


            /* 
            The current steps in onboarding are:
                
                Create account - 0%
                Activate account - 20%
                Provide profile information - 40%
                What jobs are you interested in? - 50%
                Do you have relevant experience in these jobs? - 70%
                Are you a freelancer? - 90%
                Waiting for approval - 99%
                Approval - 100%

            */
            //heightcharts xAxis categories
            $categoryArray = array (
                '0', 
                '20',
                '40',
                '50',
                '70',
                '90',
                '99',
                '100'
            );

            //xAxis
            $data ["xAxis"] = array (
                "categories" => $categoryArray,
                 "title" => array (
                    "text" => "Step in the Onboarding"
                )
            );

            //Chart Type
            $data ["chart"] = array (
                "type" => "spline"
            );

            //Chart Title
            $data ["title"] = array (
                "text" => "Weekly Retention Curve of Temper Onboarding Flow"
            );

            //Subtitle
            $data ["subtitle"] = array (
                "text" => "By Lakmin"
            );


            return $data;


        } else {

            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        }
    }
}
