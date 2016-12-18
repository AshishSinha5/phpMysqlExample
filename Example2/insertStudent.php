<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InsertStudent
 *
 * @author root
 */
require_once 'database/database.php';
class InsertStudent {
    //put your code here
   private  $name,$databaseObj,$rowCount;
   
    public function __construct() {
        $this->databaseObj=new Database();
    }
   
    public function setName($name){
        $this->name=$name;   
    }
    public function insertStudent(){
        $this->databaseObj->query = "call insertStudent(?)";
        $this->databaseObj->stmt = $this->databaseObj->prepare($this->databaseObj->query);
        $this->databaseObj->stmt->bind_param('s', $this->name); //i for integer , s for string
        $this->databaseObj->stmt->execute();
        $this->rowCount= $this->databaseObj->getResultantRow();
    }
    public function successMessage(){
        if ($this-> rowCount >0){
           return array("msg"=>"Row Success fully inserted");
        }
        else {
            return array("msg"=>"Insertion Failed");
        }
    }
}
$obj=new InsertStudent();
$json = json_decode(file_get_contents("php://input"));
if (!is_null($json->name)) {
    $obj->setName($json->name);
    $obj->insertStudent();
    echo json_encode($obj->successMessage());
} else {
    echo json_encode(array("error" => "name not set"));
}