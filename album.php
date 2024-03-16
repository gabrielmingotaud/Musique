<?php
try{
    $connect = new PDO('mysql:host=localhost;dbname=Musique','root','');
}catch(PDOException $e){
    echo "problème de connexion à la BDD <br>". $e->getMessage();
}

$requeteAlbum = "select * from album JOIN artiste ON idArtiste = artiste.id where album.id=".$_GET['id'];
$resultatRequeteAlbum = $connect->query($requeteAlbum);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleModif.css">
    <title>Noter</title>
</head>
<body>
    <header>
    <nav class="nav">
            <ul class="nav-left">
                <li><a href="index.php" class="link-nav">Accueil</a></li>
                <li><a href="classement.php" class="link-nav">Classement</a></li>
            </ul>
            <ul class="nav-right">
                <div class="search-nav">
                    <form class="search-nav" action="filtre.php" method="POST">
                        <li><input type="text" class="inputText-nav" placeholder="Recherche" name="search"></li>
                        <li><input type="submit" class="inputSubmit-nav" value="Rechercher" name="submit"></li>
                    </form>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <div class="centre-container width80 colonne">

            <?php
            while($album = $resultatRequeteAlbum->fetch(PDO::FETCH_OBJ)){
            ?>
            <div class="titre-soulignement">
                <h1 class="gros-titre"><?= $album->Titre; ?></h1>
                <div class="soulignement"></div>
            </div>
            <img src="Images/<?=$album->Pochette; ?>" class="grande-image">
            <h3>De <?= $album->Nom;?> <?= $album->Prenom; ?></h3>
            <div class="titre-soulignement padding10">
                <h2>Description:</h2>
                <div class="soulignement"></div>
            </div>
            <p><?= $album->Description; ?></p>
            <?php } ?>


        </div>
    </main>
    
</body>
</html>


