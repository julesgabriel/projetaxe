<?php
session_start();
$_SESSION = array();
session_destroy();// détruire la session
header('Location: connexionadmin.php');//rediriger à la page connexion

