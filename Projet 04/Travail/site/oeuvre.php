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
        <img src="<?= htmlspecialchars($oeuvre['image_path'], encoding: 'utf-8') ?>" alt="<?= htmlspecialchars($oeuvre['title'], encoding: 'utf-8') ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= htmlspecialchars($oeuvre['title'], encoding: 'utf-8') ?></h1>
        <p class="description"><?= htmlspecialchars($oeuvre['artist_name'], encoding: 'utf-8') ?></p>
        <p class="description-complete">
             <?= htmlspecialchars($oeuvre['description'], encoding: 'utf-8') ?>
        </p>
    </div>
</article>

<?php require_once 'footer.php'; ?>
