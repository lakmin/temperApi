<?php 
$args = array
(
    array( 'type' => 'AAA', 'label_id' => 'A1,35' ),
    array( 'type' => 'AAA', 'label_id' => 'A2,34' ),
    array( 'type' => 'BBB', 'label_id' => 'B1,29' ),
    array( 'type' => 'CCC', 'label_id' => 'C1,20' ),
    array( 'type' => 'CCC', 'label_id' => 'C2,19' ),
    array( 'type' => 'CCC', 'label_id' => 'C3,18' )  
);

$tmp = array();

foreach($args as $arg)
{
    $tmp[$arg['type']][] = $arg['label_id'];
}

$output = array();

foreach($tmp as $type => $labels)
{
    $output[] = array(
        'type' => $type,
        'label_id' => $labels
    );
}

print_r($output);

?>