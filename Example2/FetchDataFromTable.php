<?php
    require_once 'database/database.php';
    class FetchAllStudents{
        private $allStudents,$databaseObj;
        
        public function __construct() {
            $this->allStudents= array();
            $this->databaseObj=new Database();
        }
        function getAllStudents(){
            $this->databaseObj->query="call selectAll()";
            $this->databaseObj->stmt=$this->databaseObj->prepare($this->databaseObj->query);
            $this->databaseObj->stmt->execute();
            $this->allStudents=  $this->databaseObj->getMultipleResultantRows();
            return $this->allStudents;
        }
    }

$obj=new FetchAllStudents();    
echo json_encode($obj->getAllStudents());