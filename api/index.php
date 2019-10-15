<?php
include_once('classes/Header.php');
include_once('classes/Api.php');

$Api = new Api();

$dataload = $Api->csvConnect('db/data.csv');
$data = $Api->api_load_json_data($dataload);

if($data){ 
    echo json_encode($data);

} else {
    echo json_encode(array("message" => "Unable to load data from CSV Data file"));
}

?>