<?php
    /*
    * Page d'ajout d'une oeuvre par formulaire.
    * -----------------------------------------
    */
    session_start();
    require 'header.php';
?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="title">Titre de l'œuvre</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div class="champ-formulaire">
        <label for="artist_name">Auteur de l'œuvre</label>
        <input type="text" name="artist_name" id="artist_name" required>
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image_path" id="image_path" required>
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" required></textarea>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>
