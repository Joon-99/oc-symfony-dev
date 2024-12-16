<?php
    /*
    * Page d'accueil
    *-------------------
    */
    session_start();
    require_once 'header.php';
    require_once 'db-pdo.php';
    try {
        $client = connectDB();
        $oeuvres = getOeuvres($client);
    } catch (Exception $e) {
        die($e->getMessage());
    }
?>
<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= htmlspecialchars($oeuvre['id'], encoding: 'utf-8') ?>">
                <img src="<?= htmlspecialchars($oeuvre['image_path'], encoding: 'utf-8') ?>" alt="<?= htmlspecialchars($oeuvre['title'], encoding: 'utf-8') ?>">
                <h2><?= htmlspecialchars($oeuvre['title'], encoding: 'utf-8') ?></h2>
                <p class="description"><?= htmlspecialchars($oeuvre['artist_name'], encoding: 'utf-8') ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require_once 'footer.php'; ?>
