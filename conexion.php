<?php

define('SERVIDOR', 'localhost');
define('DB', 'negocio');
define('USER', 'root');
define('PASSWORD', '');

function connect(){
    try {
        $conexion=new PDO("mysql:host=".SERVIDOR.";dbname=".DB, USER, PASSWORD);
        return $conexion;
        echo "conexion exitosa";
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    };
}


?>