<?php

try{
    $connect = new PDO('mysql:host=localhost;dbname=Musique','root','');
}catch(PDOException $e){
    echo "problème de connexion à la BDD <br>". $e->getMessage();
}


?>