<?php

class BDD{
    private $host = "localhost";
    private $port = "8889";
    private $db = "projet";
    private $user = "root";
    private $pwd = 'root';

    protected $co = false;

    public function __construct(){
        if($this->co == false){
            try{
                $this->co = new PDO("mysql:host=$this->host;
                port=$this->port;
                dbname=$this->db", $this->user, $this->pwd);
                $this->co->exec("SET NAMES 'UTF8'");
                $this->co->exec( "SET CHARACTER SET utf8" );
            }

            catch(Exception $e){
                die('Erreur' .$e->getMessage());
            }
        }
    }
}

?>