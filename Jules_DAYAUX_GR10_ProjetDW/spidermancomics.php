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
FROM articlescomics
ORDER BY id;d
";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
    echo "il y a un problème";
} else {
    $articlescomics = mysqli_fetch_all($results, MYSQLI_ASSOC);
    // var_dump($articles);

}

?>

<?php
$title ='Article comics';

include 'header.php' ?>
<!-- display et style des articles -->

<div id="getoutfooter">
    <ul id="stylearticles">


        <?php if (empty($articlescomics)):  // si il n'y a pas d'articles ?>
            <p>Il n'y a aucun article</p>
        <?php endif ?>
        <a href="ajoutdarticlecomics.php">
            <button id="buttonadd">Ajouter un article</button>
        </a>
        <?php foreach ($articlescomics as $articles): ?>

            <!-- display les articles en récupérant les données de la base de données -->

            <li>
                <h3 id="styletitreart"><?= ($articles ['titre']); ?></h3>
                <div class="centreimagecomics">
                    <img id="stylegalerie" alt="comicsartimage" src="<?= $articles['fileToUpload']; ?>">
                </div>
                <p id="stylecontenuart"><?= $articles ['contenu']; ?></p><br>
            </li>

            <!-- display les articles en récupérant les données de la base de données - fin -->

        <?php endforeach; ?>
        <br>
        <br>


    </ul>
</div>


<?php include "footer.php" ?>
