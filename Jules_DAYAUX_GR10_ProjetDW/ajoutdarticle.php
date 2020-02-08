
<?php require 'header.php' ?>

<?php

require 'connexion.php';
?>



<h1 id="titrearticle">Ajouter un nouvel article</h1>
<hr>
<div id="justifyform">
    <form action="traitementajoutarticle.php" method="post" id="formarticle" enctype="multipart/form-data"><!-- need lapage de traitement pour fonctionner -->
        <div>
            <label for="titre"></label<br>
            <input id="titre" name="titre" placeholder="Titre de l'article">
        </div>
        <div>

        <input  type="file" name="fileToUpload" id="fileToUpload">

        <div>
            <br>
            <label for="contenu"></label><br>
            <textarea name="contenu"  rows="4" cols="40" id="contenu" placeholder="contenu de l'article"></textarea>
        </div>
        <br>
        </div>
        <button>Ajouter</button>
    </form>
</div>


<?php require 'footer.php' ?>
