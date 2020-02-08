<?php
$title ='Contact';
include "header.php"; ?>

<?php

$bdd = new PDO ('mysql:host=127.0.0.1;dbname=spidermansite', 'root', 'root');


if (isset($_POST['envoyer'])) {
    $mail = htmlspecialchars($_POST['mail']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);
    $insertmbr = $bdd->prepare("INSERT INTO contact (mail,sujet,message) VALUES (?,?,?) ");
                            $insertmbr->execute(array($mail, $sujet, $message));
                            $erreur = "Votre email à bien été envoyé!";
}
?>





<div id="main">
    <div id="form">
        <h2 id="formulaire"><u> formulaire de contact </u></h2>
        <form action="contact.php" method="post">
            Mail:<br> <input id="mail" type="text" name="mail" value=""/><br><br>

            Sujet:<br> <input type="text" name="sujet" value=""/><br><br>
            Message:<br>
            <textarea  name="message" cols="40" rows="20"></textarea><br><br>

            <input id="envoyer" type="submit" name="envoyer" value="Envoyer"/>
    </div>


    <iframe id="googlemaps"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2619.619950292219!2d2.3614356159055907!3d48.96072210144978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66968bb58ca2b%3A0xf309c02fd856c53d!2s67+Avenue+Potier%2C+93380+Pierrefitte-sur-Seine!5e0!3m2!1sfr!2sfr!4v1556198185096!5m2!1sfr!2sfr"
            width="840" height="560" frameborder="0" style="border:4px solid white" allowfullscreen></iframe>

</div>
<div id="smallespace"></div>
<div id="positionmessage">
</div>


<?php include "footer.php"; ?>

