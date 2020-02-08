<?php
/* se connecter à la bdd en methode mysqli */
$db_host = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "spidermansite";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}
?>
