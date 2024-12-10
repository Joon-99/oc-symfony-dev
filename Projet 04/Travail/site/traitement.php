<?php
/*
* Traitement de l'ajout d'une oeuvre.
* -----------------------------------
*/
session_start();
require_once 'config.php';
require_once 'db-pdo.php';


/*
* Crée une notification en session et redirige vers la page désirée.
* $type : le type de notification désirée, conditionne l'affichage du message.
* $msg : le message à afficher en notification.
* $location : la page de destination de la redirection
* $details : un tableau de chaînes supplémentaires si besoin
*/
function customRedirect(string $type, string $msg, string $location = REDIR_DEFAULT_LOC, $details = []): void {
    $types = [
        NOTIF_TYPE_ERROR,
        NOTIF_TYPE_WARNING,
        NOTIF_TYPE_SUCCESS,
        NOTIF_TYPE_INFO,
    ];
    $type = in_array($type, $types) ? $type : NOTIF_TYPE_INFO;
    $redirectNotif[] = $msg;
    foreach ($details as $detail) {
        if (is_string($detail)) {
            $redirectNotif[] = $detail;
        }
    }
    $_SESSION['notification'] = ['type' => $type, 'messages' => $redirectNotif];
    header("Location: $location");
    exit();
}

/*
* Valide l'input envoyé par l'utilisateur lors de la création d'une oeuvre.
*/
//TODO CHANGE TO HTMLSPECIALCHARS()
//TODO FINISH COMMENTS
function isValidOeuvreInput(string $title, string $artistName, string $description, string $imagePath): bool {
    $title = trim(filter_var($title, FILTER_SANITIZE_STRING));
    $artistName = trim(filter_var($artistName, FILTER_SANITIZE_STRING));
    $description = trim(filter_var($description, FILTER_SANITIZE_STRING));
    $imagePath = trim(filter_var($imagePath, FILTER_SANITIZE_URL));

    $hasValidTitle = $title && mb_strlen($title) <= 50;
    $hasValidArtist = $artistName && mb_strlen($artistName) <= 30;
    $hasValidDescription = $description && (3 <= mb_strlen($description) && mb_strlen($description) <= 65535);

    $parsedURL = parse_url($imagePath);
    $scheme = $parsedURL['scheme'] ?? null;
    $isValidScheme = in_array($scheme, EXT_IMG_PROTOCOLS);
    $hasValidPath = filter_var($imagePath, FILTER_VALIDATE_URL) && $isValidScheme;

    return $hasValidTitle && $hasValidArtist && $hasValidDescription && $hasValidPath;
}

$oTitle = isset($_POST['title']) ? $_POST['title'] : '';
$oArtistName = isset($_POST['artist_name']) ? $_POST['artist_name'] : '';
$oDescription = isset($_POST['description']) ? $_POST['description'] : '';
$oImagePath = isset($_POST['image_path']) ? $_POST['image_path'] : '';
if (isValidOeuvreInput($oTitle, $oArtistName, $oDescription, $oImagePath)) {
    try {
        $client = connectDB();
        addOeuvre($client, [
            'title' => $oTitle,
            'artist_name' => $oArtistName,
            'description'=> $oDescription,
            'image_path' => $oImagePath,
        ]);
    } catch (Exception $e) {
        customRedirect(
            NOTIF_TYPE_ERROR,
            "Erreur pendant l'insertion dans la base de données : {$e->getMessage()}",
        );
    }
    customRedirect(
        NOTIF_TYPE_SUCCESS,
        "Votre oeuvre a été ajoutée !",
        "oeuvre.php?id={$client->lastInsertId()}",
    );
} else {
    customRedirect(
        NOTIF_TYPE_WARNING,
        "Votre oeuvre n'a pas pu être ajoutée car elle ne respecte pas au moins une des contraintes suivantes : ",
        "ajouter.php",
        OEUVRES_CONSTRAINTS,
    );
}
require_once 'footer.php';