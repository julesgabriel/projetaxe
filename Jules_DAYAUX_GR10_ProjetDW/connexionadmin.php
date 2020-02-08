<?php $title = "Connexion";?>

<?php
session_start();
include 'header.php';

$bdd = new PDO ('mysql:host=127.0.0.1;dbname=spidermansite', 'root', 'root');/* se connecter en pdo*/

if (isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);//crypter le mot de passe
    if (!empty($mailconnect) AND !empty($mdpconnect) || !empty($mailconnect) || !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM admin WHERE mail = ? AND password = ? ");//preparer à récupéré les données via une requete
        $requser->execute(array($mailconnect, $mdpconnect));// executer la requete
        $userexist = $requser->rowCount();//compter le nombre de ligne
        if ($userexist == 1) {//si la variable userexist == 1 et est = a ce qui a été entré
            $userinfo = $requser->fetch(); // traverser tout le tableau selon chaque variable
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['user'] = $userinfo['user'];
            $_SESSION['mail'] = $userinfo['mail'];
            $_SESSION['role'] = $userinfo['role'];
            header("Location: profil.php?id=" . $_SESSION['id']); // rediriger à la page de gestion du profil
        } else {
            $erreur = "Mauvais mail ou mauvais mot de passe";
        }
    } else {
        $erreur = "Tous les champs doivent ere completes";
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="positionform">
<div class="styleconnins">
    <h2><u>Connexion</u></h2>
    <br>
    <br>
    <form method="post" action="">

        <input type="email" name="mailconnect" placeholder="Mail"><br><br>
        <input type="password" name="mdpconnect" placeholder="Mot de passe"><br><br>
        <input type="submit" name="formconnexion" placeholder="Se connecter!">

    </form>
</div>
<?php
if (isset($erreur)) {
    echo $erreur;
}
?>
</div>




<?php include 'footer.php'; ?>
