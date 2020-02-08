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
FROM images
ORDER BY id;
";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
    echo "il y a un problème";
} else {
    $images = mysqli_fetch_all($results, MYSQLI_ASSOC);
    // var_dump($articles);

}

?>

<?php $title = "Galerie"; ?>

<?php include 'header.php' ?>

<form class="uploadimg" action="upload.php" method="post" enctype="multipart/form-data">
    <!-- need la page upload pour que le form fonctionne -->
    <p id="selectimage">Selectionner l'image a upload:</p><br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit" id="stylesubmitgalerie">
</form>


<div id="getoutfooterfill">

    <ul>
        <?php if (empty($images)): //dire si il n'y a pas d'images ?>
            <p>Il n'y a aucune image</p>
        <?php endif ?>
        <?php foreach ($images as $imagesurl): ?>
            <li class="listgalerie">
                <img class="stylegalerie" src="<?= $imagesurl ["fileToUpload"]; ?>" alt="imagegalerie">
            </li>
        <?php endforeach; // display les images?>
    </ul>

</div>

<?php include 'footer.php' ?>


