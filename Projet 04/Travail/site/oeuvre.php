<?php
    /*
    * Page individuelle d'une oeuvre.
    * ------------------------------
    */
    session_start();
    require_once 'header.php';
    require_once 'db-pdo.php';

    // Si l'URL ne contient pas d'id ou n'est pas un int, on redirige sur la page d'accueil
    $oeuvreId = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if(!$oeuvreId) {
        header('Location: index.php');
        exit();
    }

    // Récupération de l'oeuvre.
    $oeuvre = null;
    try {
        $client = connectDB();
        $oeuvre = getOeuvreById($client, $oeuvreId);
    } catch (Exception $e) {
        die($e->getMessage());
    }

    //Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(!$oeuvre) {
        header('Location: index.php');
        exit();
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image_path'] ?>" alt="<?= $oeuvre['title'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['title'] ?></h1>
        <p class="description"><?= $oeuvre['artist_name'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require_once 'footer.php'; ?>
