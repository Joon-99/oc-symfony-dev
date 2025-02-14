<?php
//TODO commentaires
//TODO check htmlspecialchars
function insertOrderButton(string $column, string $order, string $char): string
{
    $class = $_SESSION['column'] === $column && $_SESSION['order'] === $order ? 'statsActiveOrder' : '';
    $buttonHtml = "<a class=\"$class\" href=\"index.php?action=showStats&column=$column&order=$order\">$char</a>";
    return $buttonHtml;
}

?>

<h2>Statistiques</h2>

<div class="adminArticle statsTable">
    <div class="articleLine">
        <?php
        $columnNames = [
            'title' => 'Titre',
            'nb_views' => 'Nombre de vues',
            'nb_comments' => 'Nombre de commentaires',
            'date_creation' => 'Date de publication',
        ];
        foreach ($columnNames as $column => $name) {
            echo "<div class=\"title\">" . insertOrderButton($column, 'DESC', '▲') . insertOrderButton($column, 'ASC', '▼') . "<span>$name</span></div>";
        }
        ?>
    </div>
    <?php foreach ($articles as $key => $article) {
        $bgColorClass = $key % 2 == 0 ? "even" : "odd";
        ?>
        <div class="articleLine">
            <div class="content <?= $bgColorClass ?>"><?= htmlspecialchars($article->getTitle()) ?></div>
            <div class="content <?= $bgColorClass ?>"><?= $article->getNbViews() ?></div>
            <div class="content <?= $bgColorClass ?>"><?= $article->getNbComments() ?></div>
            <div class="content <?= $bgColorClass ?>"><?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?>
            </div>
        </div>
    <?php } ?>
</div>