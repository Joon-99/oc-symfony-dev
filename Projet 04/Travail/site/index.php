<?php
    require 'header.php';
    const DB_HOST = "localhost";
    const DB_NAME = "artbox-p04";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_CONNECTION_CHARSET = "utf8mb4";
    $cV = function ($constant) { return $constant; }; // trick for constant string interpolation

    // watch out, php doesn't throw anything if you send a named parameter with a typo, aaargh...
    $dbConnectStr = "mysql:host={$cV(DB_HOST)};dbname={$cV(DB_NAME)};charset={$cV(DB_CONNECTION_CHARSET)};";
    try {
        $client = new PDO(
            $dbConnectStr,
            DB_USER,
            DB_PASSWORD,
        );
    } catch (Exception $e) {
        die("Error during connection to the DB server: " . $e->getMessage());
    }
    $oeuvres = $client->query("SELECT * FROM oeuvres")->fetchAll();
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
<?php require 'footer.php'; ?>
