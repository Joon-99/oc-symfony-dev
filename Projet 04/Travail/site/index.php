<?php
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
            <a href="oeuvre.php?id=<?=$oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image_path'] ?>" alt="<?= $oeuvre['title'] ?>">
                <h2><?= $oeuvre['title'] ?></h2>
                <p class="description"><?= $oeuvre['artist_name'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require_once 'footer.php'; ?>
