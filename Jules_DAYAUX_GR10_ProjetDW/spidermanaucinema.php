<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "spidermansite";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}
//echo "c'est super tout va bien";
$sql = "SELECT * 
FROM articlescinema
ORDER BY id;
";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
    echo "il y a un problème";
} else {
    $articlescinema = mysqli_fetch_all($results, MYSQLI_ASSOC);
    // var_dump($articles);
}

?>

<?php
$title ='Article cinema';
include 'header.php' ?>
<!-- display et style des articles -->
<div id="getoutfooter">

    <ul id="stylearticles">


        <?php if (empty($articlescinema)): // si il n'y a pas d'articles?>
            <p>Il n'y a aucun article</p>
        <?php endif ?>
        <a href="ajoutdarticle.php">
            <button id="buttonadd">Ajouter un article</button>
        </a>
        <?php foreach ($articlescinema as $articles): ?>


        <!-- display les articles en récupérant les données de la base de données -->
            <li>
                <h3 id="styletitreart"><?= $articles ['titre']; ?></h3>
                <div class="articlecinemaimg">
                    <img src="<?= $articles['fileToUpload']; ?>" alt="cinemaarticleimage">
                </div>
                <p id="stylecontenuart"><?= $articles ['contenu']; ?></p><br>

            </li>
            <!-- display les articles en récupérant les données de la base de données - fin -->

        <?php endforeach; ?>
        <!-- display et style des articles - fin -->

        <br>
        <br>
    </ul>
</div>


<?php include "footer.php" ?>
