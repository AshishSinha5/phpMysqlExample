<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FetchStudent
 *
 * @author Varun
 */
require_once 'database/database.php';

class FetchStudent {

    //put your code here

    private $student, $databaseObj, $id;

    public function __construct() {
        $this->students = array();
        $this->databaseObj = new Database();
    }

    function getStudent() {
        $this->databaseObj->query = "call selectStudent(?)";
        $this->databaseObj->stmt = $this->databaseObj->prepare($this->databaseObj->query);
        $this->databaseObj->stmt->bind_param('i', $this->id);
        $this->databaseObj->stmt->execute();
        $this->student = $this->databaseObj->getResultantRow();
        return $this->student;
    }
    public function setId($id) {
        $this->id = $id;
    }
}

$obj = new FetchStudent();
$json = json_decode(file_get_contents("php://input"));
if (!is_null($json->id)) {
    $obj->setId($json->id);
    echo json_encode($obj->getStudent());
} else {
    echo json_encode(array("error" => "Id not set"));
}


