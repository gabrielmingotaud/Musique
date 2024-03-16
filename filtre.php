<?php

try{
    $connect = new PDO('mysql:host=localhost;dbname=Musique','root','');
}catch(PDOException $e){
    echo "problème de connexion à la BDD <br>". $e->getMessage();
}


$search = strtolower($_POST["search"]);
$search = htmlspecialchars($search);
$requeteAlbum = $connect->prepare("select * from album where lower(Titre) like :search");
$search = '%'.$search.'%';
$requeteAlbum->bindParam(':search', $search, PDO::PARAM_STR);
$requeteAlbum->execute();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleModif.css">
    <title>Filtre</title>
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
        <div class="container width100">
            <div class="titre-soulignement">
                <h1 class="gros-titre">Filtre</h1>
                <div class="soulignement"></div>
            </div>

            <div class="sous-container flex-centre colonne width80">
                
                <table class="width80">
                <tr class="background-tab-titre">
                    <th class="width30">Titre</th>
                    <th class="width30">Pochette</th>
                    <th class="width30">Noter ?</th>
                </tr>

                <?php
                while($album = $requeteAlbum->fetch(PDO::FETCH_OBJ)){
                ?>
                    <tr class="background-tab">
                        <td><?= $album->Titre; ?></td>
                        <td><img src="Images/<?= $album->Pochette; ?>"></td>
                        <td><a href="noter.php?id=<?= $album->id;?>" class="btn-input">Noter</a></td>
                    </tr>
                <?php } ?>
            </table>

            </div>

        </div>
    </main>
    
</body>
</html>