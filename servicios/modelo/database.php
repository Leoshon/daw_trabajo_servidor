<?php
class Database{
    protected $conexion;
    public function __construct(){
        try{
            $dsn = "mysql:host=localhost; dbname=carritocompra; charset=UTF8";
            $this->conexion = new PDO($dsn, "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
        }
        catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }

    }
}
