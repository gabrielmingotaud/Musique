<?php

try{
    $connect = new PDO('mysql:host=localhost;dbname=Musique','root','');
}catch(PDOException $e){
    echo "problème de connexion à la BDD <br>". $e->getMessage();
}


$commentaire = htmlspecialchars($_POST["commentaire"]);
$requeteAjoutNote = $connect->prepare("insert into noter(idOeuvre, note, commentaire) values(:idAlbum, :note, :commentaire)");
$requeteAjoutNote->bindParam(':idAlbum', $_POST["idAlbum"], PDO::PARAM_STR);
$requeteAjoutNote->bindParam(':note', $_POST["note"], PDO::PARAM_STR);
$requeteAjoutNote->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
$requeteAjoutNote->execute();

header("location: index.php")

?>