<?php
  class Database {
    
      private $host = 'localhost';
      private $db_name = 'u256725_1ogcool';
      private $username = 'u256725_1ogcool';
      private $password = 'J9ccUWMX';
      private $conn;
      

      
      //подключаем базу
      public function connect(){
          $this->conn = null;

          try {
            $this->conn = new PDO('mysql:host='. $this->host. ';dbname='. $this->db_name,
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          } catch(PDOException $e){
              echo 'Connection Error'. $e->getMessage();
          }

          return $this->conn;
      }
  }

