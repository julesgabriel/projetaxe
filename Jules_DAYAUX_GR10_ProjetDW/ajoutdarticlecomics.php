<?php require 'header.php' ?>

<?php

    require 'connexion.php';


?>


<h1 id="titrearticle">Ajouter un nouvel article</h1>
<hr>
<div id="justifyform">
    <form action="traitementajoutarticlecomics.php" method="post" id="formarticle" enctype="multipart/form-data"><!-- need lapage de traitement pour fonctionner -->
        <div>
            <label for="titre"></label<br>
            <input id="titre" name="titre" placeholder="Titre de l'article">
        </div>
        <div>
            <label for="media"></label<br>
            <input type="file" id="fileToUpload" name="fileToUpload">
        </div>
        <div>

            <label for="contenu"></label><br>
            <textarea  name="contenu" rows="4" cols="40" id="contenu " placeholder="contenu de l'article"></textarea>
        </div>
        <br>

        <button>Ajouter</button>
    </form>
</div>



<?php require 'footer.php' ?>
