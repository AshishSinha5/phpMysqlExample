<?php
    
//    var_dump($_POST); //prior php7.0 this was working
 
//converting json string to json object
    $json= json_decode(file_get_contents("php://input")); //in php7.0 only this is working
    

//for making json data in php convert every thing in php associative array
   $array= array('name' => $json->firstname . " " .$json->lastname  ); 
    
//then use json_encode to convert to json
   echo json_encode($array); //

?>