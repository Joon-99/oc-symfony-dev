<?php 
    /** 
     * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
     * Et un formulaire pour ajouter un article. 
     */
    $currentOrder = isset($_SESSION['order']) && $_SESSION['order'] !== '' ? $_SESSION['order'] : 'ASC';
    var_dump($currentOrder);
    $currentOrderChar = $currentOrder === 'DESC' ? '▲' : '▼';
?>

<h2>Statistiques</h2>

<div class="adminArticle statsTable">
    <div class="articleLine">
        <div class="title"><a href="index.php?action=showStats&column=title&order=<?= $currentOrder ?>"><?= $currentOrderChar ?></a>Titre</div>
        <div class="title"><a href="index.php?action=showStats&column=nb_views&order=<?= $currentOrder ?>"><?= $currentOrderChar ?></a>Nombre de Vues</div>
        <div class="title">Nombre de commentaires</div>
        <div class="title">Date de publication</div>
    </div>
    <?php foreach ($articles as $key => $article) {
        $bgColorClass = $key % 2 == 0 ? "even" : "odd";
        ?>
        <div class="articleLine">
            <div class="content <?= $bgColorClass ?>"><?= $article->getTitle() ?></div>
            <div class="content <?= $bgColorClass ?>"><?= $article->getNbViews() ?></div>
            <div class="content <?= $bgColorClass ?>"><?= $article->getNbComments() ?></div>
            <div class="content <?= $bgColorClass ?>"><?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></div>
        </div>
    <?php } ?>
</div>