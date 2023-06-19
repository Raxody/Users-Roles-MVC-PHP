<?php
    class Conection{
        private $host = "localhost";
        private $databaseName = "bdventasingweb"; 
        private $user = "root"; 
        private $password = "";
        private $pdo;

        public function connect(){
            try{
                $PDO = new PDO("mysql:host=".$this->host.";dbname=".$this->databaseName,$this->user,$this->password);
                return $PDO;
            }catch(PDOException $pdoException){
                return $pdoException->getMessage();
            }
        }
    }
?>