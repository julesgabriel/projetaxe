<?php

$bdd = new PDO ('mysql:host=127.0.0.1;dbname=spidermansite', 'root', 'root'); //connexion a la bdd en methode PDO


if (isset($_GET['id']) AND $_GET['id'] > 0) { // si l' index id n'existe pas et que il qu'il y a un get sur id superieur a 0
    $getid = intval($_GET['id']); // variable permettant de récupére l'id sous forme de int
    $requser = $bdd->prepare('SELECT * from admin WHERE id = ?'); //selectionner la table
    $requser->execute(array($getid)); // executer la requete et éxécuter la variable
    $userinfo = $requser->fetch(); //récupérer l'id  de la session
    session_start();// Permet de modifier les liens afficher dans la nav, afin de pouvoir récupérer les données necessaire a l'UX

} ?>

<!Doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> Spider-man - Jules DAYAUX</title>
    <link rel="icon" type="images/png" sizes="96x96" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js">
    </script>
    <script src="turnjs4/lib/turn.min.js"></script>


</head>
<body>
<div class="conteneurlogo">
    <div class="logo"><a href="https://developer.marvel.com/" target="_blank"><img src="images/marvel_logo.png"
                                                                                   alt="Logo_Marvel"> </a>
    </div>
</div>
<header>
    <a href="#" id="back-to-top" title="Back to top">&#8679;</a>
    <nav>
        <ul id="menu"><li><a href="index.php">Accueil</a></li>
            <li id="positionliens"><a href="Univers.php">Univers</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="galerie.php">Galerie</a></li>

            <?php
            if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']){// afficher seulement quand il y a un id de session récupérer dans le cache
            ?>
            <li><a href="deconnexion.php">Deconnexion</a></li>


        <?php
        }
        ?>
        </ul>
    </nav>
    <div id="burger">
        <span>&#9776;</span>

        <div id="videburger"></div>
        <div id="navbar"></div>
    </div>


</header>
<main>
