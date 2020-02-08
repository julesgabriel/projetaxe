<?php $title = "Inscription";?>
<?php
include 'header.php';

$bdd = new PDO ('mysql:host=127.0.0.1;dbname=spidermansite', 'root', 'root');

/* Définition de toutes les variables permettant de remplir les champs de la base de données chaque variable, est associé à un champ de form */

if (isset($_POST['forminscription'])) {
    $user = htmlspecialchars($_POST['user']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['password']);
    $mdp2 = sha1($_POST['password2']);
    /* fin de définition des variables */

    /* mettre tout les cas de figures donnant des erreurs ou non si les champs sont remplis, ou non ou ne respectent pas conditions données au préalable dans le code ci-dessous */
    if (!empty($_POST['user']) AND !empty($_POST['mail2']) AND !empty($_POST['mail2']) AND !empty($_POST['password']) AND !empty($_POST['password2'])) {

        $pseudolength = strlen($user);
        if ($pseudolength <= 255) {
            if ($mail == $mail2) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                    $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail=?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                        if ($mdp == $mdp2) {

                            $insertmbr = $bdd->prepare("INSERT INTO membres (user, mail, password) VALUES (?,?,?) ");
                            $insertmbr->execute(array($user, $mail, $mdp));
                            $erreur = "Votre compte a bien ete cree!
                            <br><a href=\"connexionadmin.php\">Me connecter</a>";

                        } else {
                            $erreur = "Vos mot de passe ne correspondent pas";
                        }

                    } else {
                        $erreur = "adresse mail deja utilisee";
                    }

                } else {
                    $erreur = "Votre adresse mail n'est pas valide";
                }
            } else {
                $erreur = "Vos adresses mails ne correspondent pas";
            }
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
        }
    } else {
        $erreur = "Tous les champs doivent être remplis";

    }
}
/* fin des cas de figures */

?>

<!--formulaire inscription -->
    <div class="positionform">
        <div class="styleconnins"><br>

            <h2 class="pushtop"><u>Inscription</u></h2>
            <br>
            <br>
            <form method="post" action="">

                <label for="user"> Pseudo:</label><br>
                <input type="text" id="user" placeholder="Identifiant" name="user" value="<?php if (isset($user)) {/* si il y a une erreur, echo ce que l'utilisateur à écris dans le champ avant l'erreur */
                    echo $user;
                } ?>"><br><br>

                <label for="mail"> Mail:</label><br>
                <input type="email" id="mail" placeholder="adresse e-mail" name="mail" value="<?php if (isset($mail)) {
                    echo $mail;
                } ?>"><br><br>

                <label for="mail2"> Mail:</label><br>
                <input type="email" id="mail2" placeholder="confirmer votre mail" name="mail2"
                       value="<?php if (isset($mail2)) {
                           echo $mail2;
                       } ?>"><br><br>

                <label for="password"> Password:</label><br>
                <input type="password" id="password" placeholder="Mot de passe" name="password"><br><br>

                <label for="password2"> Password:</label><br>
                <input type="password" id="password" placeholder="confirmation du mot de passe"
                       name="password2"><br><br>


                <input type="submit" name="forminscription" value="je m'inscris!">

            </form>

            <?php
            /* echo l'erreur */
            if (isset($erreur)) {
                echo $erreur;
            }
            ?>
        </div>
    </div>
<!-- fin du form -->

<?php include 'footer.php'; ?>