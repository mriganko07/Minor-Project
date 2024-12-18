<?php

include "db_config.php" ;

?>

<?php 

class database{

    public $servername   = db_server;
    public $username   = db_user;
    public $password   = db_pass;
    public $database_name = db_name;
    
    public $db;
    public $error;

    //Constructor of Database Class

    public function __construct() {
        $this->connectDB();
    }
    private function connectDB() {
        $this->db = new mysqli($this->servername, $this->username, $this->password, $this->database_name, 3307);
        
        if ($this->db->connect_error) {
            $this->error = "Connection failed: " . $this->db->connect_error;
            die($this->error);
        }
    }    
    

    //Function of Select Query
    
    public function select($sql){

        $result = $this->db->query($sql);

        if($result->num_rows > 0){
            return $result;
        }
    }

    //Function of Insert Query

    public function insert($sql){

        $result = $this->db->query($sql);

        if($result){
            return $result;
        }
        else{
            return false;
        }

    }

    //Function of Delete Query

    public function delete($sql){

        $result = $this->db->query($sql);

        if($result){
            return $result;
        }
        else{
            return false;
        }

    }

    //Function of Update Query

    public function update($sql){

        $result = $this->db->query($sql);

        if($result){
            return $result;
        }
        else{
            return false;
        }

    }



}

?>