<?php

require 'connexion.php';

?>
<?php

/* définition des variables associé au form afin d'insérer tous les articles et leurs images */
$target_dir = "images/articles_comics/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$content = addslashes (nl2br( $_POST ['contenu']));
$title = addslashes (nl2br( $_POST ['titre']));

/* fin définition des variables */


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

/* élaboration de toutes les conditions selon lesquelles l'upload de l'image / l'article donnera une erreur */

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    /* fin - élaboration de toutes les conditions selon lesquelles l'upload de l'image / l'article donnera une erreur */

/* move l'image dans le dossier local du site web */
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            /* fin - move l'image dans le dossier local du site web */


/* insérer l'image dans la base de données */
            $sql = "INSERT INTO articlescomics (titre,fileToUpload,contenu) VALUES ('$title','$target_file','$content')";
            $exec = 'mysqli_query($sql)';
            var_dump($sql);
            $results = mysqli_query($conn, $sql);
            if ($results === false) {
                echo mysqli_error($conn);
            } else {
                var_dump($sql);
                $id = mysqli_insert_id($conn);
                echo "c'est bon j'ai inséré l'image avec l'ID : $id";
            }
        }
    }
}
?>