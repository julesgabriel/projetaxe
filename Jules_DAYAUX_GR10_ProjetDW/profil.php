<?php $title = "Profil";?>

<?php
include 'header.php';//récupérer les données du header

$bdd = new PDO ('mysql:host=127.0.0.1;dbname=spidermansite', 'root', ''); //connexion a la bdd en methode PDO


if (isset($_GET['supprimer']) AND !empty($_GET['supprimer'])) {// permet de donner une instruction au href
    $supprime = (int)$_GET['supprimer'];//variable permettant d'associer un a href a une requete
    $req = $bdd->prepare('DELETE FROM admin WHERE id =?');//requere permettant de supprimer une entrée
    $req->execute(array($supprime));// executer la requete
}

$membres = $bdd->query('SELECT * FROM admin ORDER by id');//selectionner la bonne table


if (isset($_GET['supprimermail']) AND !empty($_GET['supprimermail'])) {// permet de donner une instruction au href
    $supprimemail = (int)$_GET['supprimermail'];//variable permettant d'associer un a href a une requete
    $req = $bdd->prepare('DELETE FROM contact WHERE id =?');//requere permettant de supprimer une entrée
    $req->execute(array($supprimemail));// executer la requete
}

$mail = $bdd->query('SELECT * FROM contact ORDER by id');//selectionner la bonne table

if (isset($_GET['supprimerimage']) AND !empty($_GET['supprimerimage'])) {// permet de donner une instruction au href
    $supprimeimage = (int)$_GET['supprimerimage'];//variable permettant d'associer un a href a une requete
    $req = $bdd->prepare('DELETE FROM images WHERE id =?');//requere permettant de supprimer une entrée
    $req->execute(array($supprimeimage)); // executer la requete
}

$image = $bdd->query('SELECT * FROM images ORDER by id');//selectionner la bonne table


if (isset($_GET['supprimerartcine']) AND !empty($_GET['supprimerartcine'])) {// permet de donner une instruction au href
    $supprimeartcine = (int)$_GET['supprimerartcine'];//variable permettant d'associer un a href a une requete
    $req = $bdd->prepare('DELETE FROM articlescinema WHERE id =?');//requere permettant de supprimer une entrée
    $req->execute(array($supprimeartcine)); // executer la requete
}

$articlecinema = $bdd->query('SELECT * FROM articlescinema ORDER by id');//selectionner la bonne table


if (isset($_GET['supprimerartcomics']) AND !empty($_GET['supprimerartcomics'])) { // permet de donner une instruction au href
    $supprimeartcomics = (int)$_GET['supprimerartcomics']; //variable permettant d'associer un a href a une requete
    $req = $bdd->prepare('DELETE FROM articlescomics WHERE id =?'); //requere permettant de supprimer une entrée
    $req->execute(array($supprimeartcomics)); // executer la requete
}

$articlecomics = $bdd->query('SELECT * FROM articlescomics ORDER by id'); //selectionner la bonne table


if (isset($_GET['id']) AND $_GET['id'] > 0) { // si l' index id n'existe pas et que il qu'il y a un get sur id superieur a 0
    $getid = intval($_GET['id']); // variable permettant de récupére l'id sous forme de int
    $requser = $bdd->prepare('SELECT * from admin WHERE id = ?'); //selectionner la table
    $requser->execute(array($getid)); // executer la requete et éxécuter la variable
    $userinfo = $requser->fetch(); //récupérer l'id  de la session
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


<?php
$_SESSION['role'] = $userinfo['role'];
if   ($_SESSION['role']== 1){?>


<div align="center">
    <h2>Administrateur - <?php echo $userinfo['user']; ?></h2>  <!-- display le nom de l'utilisateur des logs -->
    <br>
    <br>
    user = <?php echo $userinfo['user']; ?><br>  <!-- display le nom de l'utilisateur du logged in -->
    Mail = <?php echo $userinfo['mail']; ?> <!-- display le mail du logged in -->
    <?php
    if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
        ?>
        <br><a class="profilint" href="index.php">Retour a l'accueil</a>
        <br><a class="profilint" href="deconnexion.php">Se deconnecter</a><!-- Amenne a la destruction de la session -->
        <?php
    }
    else {
        header("Location: index.php");
    }
    ?>
</div>
<br>

<!-----------------------------------------Listing des membres et administrateurs ----------------------------------------------------->

<div align="center" class="ajd">
    <h2>Membres</h2><br>
    <ul class="membrelol">
        <div class="lisuf">
            <?php while ($m = $membres->fetch()){ ?>

            <li class="membre">
                <?= $m['id'] ?> : <?= $m['user'] ?><br>
                <a href="profil.php?supprimer=<?= $m['id'] ?>">Supprimer</a><?php } ?>
            </li>
        </div>
    </ul>
    <br>

    <!-----------------------------------------Listing des différentes demandes de contact ----------------------------------------------------->

    <h2>Contact</h2>
    <br>

    <ul class="articlecontact">
        <?php while ($ma = $mail->fetch()){ ?>
        <li>
            <?= $ma['id'] ?> <br> Mail du destinataire: <b><?= $ma['mail'] ?></b> <u><br><?= $ma['sujet'] ?>
            </u><br><?= $ma['message'] ?><br>
            <a href="profil.php?supprimermail=<?= $ma['id'] ?>">Supprimer</a><?php } ?>
        </li>
    </ul>
    <br>

    <!-----------------------------------------Boucle affichage images galerie ----------------------------------------------------->

    <h2>Images galerie</h2>
    <ul class="ulclassimgprof">
        <?php while ($i = $image->fetch()){ ?>
        <li>
            <?= $i['id'] ?> : <?= $m['name'] ?>
            <div class="styleliprofimages">
                <img class="smallimages" src="<?= $i['fileToUpload'] ?>"><br>
                <a href="profil.php?supprimerimage=<?= $i['id'] ?>">Supprimer</a><?php } ?>
            </div>
        </li>
    </ul>

    <!-----------------------------------------Boucle affichage article cinema----------------------------------------------------->
    <h3>Articles</h3>
    <h2>Articles cinema</h2>
    <ul class="articlecontact">
        <?php while ($aci = $articlecinema->fetch()){ ?>
        <li>
            <?= $aci['id'] ?> <br><b><?= $aci['titre'] ?></b><u><br><img
                        src="<?= $aci['fileToUpload'] ?>"></u><br><?= $aci['contenu'] ?><br>
            <br><a href="profil.php?supprimerartcine=<?= $aci['id'] ?>">Supprimer</a><?php } ?>
        </li>
    </ul>
    <br>

    <!-----------------------------------------Boucle affichage article cinema----------------------------------------------------->
    <h2>Articles cinema</h2>
    <ul class="articlecontact">
        <?php while ($aco = $articlecomics->fetch()){ ?>
        <li>
            <?= $aco['id'] ?> <br> <b><?= $aco['titre'] ?></b><u><br><img
                        src="<?= $aco['fileToUpload'] ?>"></u><br><?= $aco['contenu'] ?><br>
            <br><a href="profil.php?supprimerartcomics=<?= $aco['id'] ?>">Supprimer</a><?php } ?>
        </li>
    </ul>
    <br>
</div>
<?php
}
else{?>
<div class="degagelo"></div>

<?php }?>

<?php include 'footer.php' ?><!-- récupérer les données du footer -->