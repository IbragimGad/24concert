<?php
        try {
        
        $bdd = new PDO("mysql:host=localhost;dbname=ibragimgadzhiev","ibragimgadzhiev","2C9O9u2ac@");
 
        }catch(Exception $e){
        
            die("ERROR : ".$e->getMesssage());
        }        
?>