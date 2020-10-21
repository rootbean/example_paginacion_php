<?php

function conexionBD() {

    try {
        $connection_bd = new PDO('mysql:host=localhost; dbname=example_paginacion', 'root', '');
        $connection_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection_bd->exec('SET CHARACTER SET utf8');
    
        return $connection_bd;
    } catch( Exception $e) {
        die('Error: '.$e->GetMessage());
    } 

}

?>