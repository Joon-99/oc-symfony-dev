<?php
/*
* Gestion de la BDD.
*-------------------
*/

/*
* Se connecte à la BDD et renvoie la connexion PDO en cas de succès.
*/
function connectDB(): PDO {
    $DB_HOST = "localhost";
    $DB_NAME = "artbox-p04";
    $DB_USER = "root";
    $DB_PASSWORD = "";
    $DB_CONNECTION_CHARSET = "utf8mb4";

    // watch out, php doesn't throw anything if you send a named parameter with a typo
    $DB_CONNECT_STR = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset={$DB_CONNECTION_CHARSET};";
    try {
        $client = new PDO(
            $DB_CONNECT_STR,
            $DB_USER,
            $DB_PASSWORD,
        );
    } catch (Exception $e) {
        throw new Exception("Error while connecting to the DB server: " . $e->getMessage());
    }
    return $client;
}

/*
* Exécute une requête en lecture.
* $multipleRows peut se mettre à false si on souhaite une seule ligne.
*/
function getQueryResult(PDO $client, string $query, array $parameters = null, bool $multipleRows = true): array | bool {
    try {
        $pdoStatement = $client->prepare($query);
        $pdoStatement->execute($parameters);
        if ($multipleRows) {
            $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        throw new Exception("Error whle executing the following query: {$query}: ". $e->getMessage());
    }
    return $result;
}

/*
* Exécute une requête en écriture:
*/
function setQuery(PDO $client, string $query, array $parameters = null) {
    try {
        $pdoStatement = $client->prepare($query);
        $pdoStatement->execute($parameters);
    } catch (Exception $e) {
        throw new Exception("Error whle executing the following query: {$query}: ". $e->getMessage());
    }
}

/*
* Requête de récupération des oeuvres.
*/
function getOeuvres(PDO $client): array {
    $sql = <<<SQL
    SELECT * FROM oeuvres
    SQL;
    return getQueryResult($client, $sql);
}

/*
* Requête de récupération d'une oeuvre par id.
*/
function getOeuvreById(PDO $client, int $id): array | bool {
    $sql = <<<SQL
    SELECT * FROM oeuvres
    WHERE id = :id
    SQL;
    $parameters = [
        "id" => $id,
    ];
    return getQueryResult($client, $sql, $parameters, multipleRows: false);
}

/*
* Requête d'ajout d'une oeuvre.
*/
function addOeuvre(PDO $client, array $oeuvre) {
    $sql = <<<SQL
    INSERT INTO oeuvres(title, artist_name, description, image_path)
    VALUES (:title, :artist_name, :description, :image_path)
    SQL;
    $parameters = [
        "title" => $oeuvre["title"],
        "artist_name" => $oeuvre["artist_name"],
        "description" => $oeuvre["description"],
        "image_path" => $oeuvre["image_path"],
    ];
    setQuery($client, $sql, $parameters);
}