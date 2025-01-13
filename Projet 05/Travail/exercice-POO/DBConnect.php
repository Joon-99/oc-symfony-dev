<?php
require_once "Config.php";
class DBConnect
{
    private string $DB_CONNECT_STR;

    private PDO $pdoInstance;

    public function __construct()
    {
        // watch out, php doesn't throw anything if you send a named parameter with a typo
        $this->DB_CONNECT_STR = "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=" . Config::DB_CONNECTION_CHARSET . ";";
    }

    public function getPDO(): ?PDO
    {
        try {
            $pdoClient = new PDO(
                $this->DB_CONNECT_STR,
                Config::DB_USER,
                Config::DB_PASSWORD,
            );
        } catch (Exception $e) {
            return null;
        }
        return $pdoClient;
    }

    public function execQuery(PDO $pdoClient, $sql, $parameters = []): PDOStatement
    {
        try {
            $statement = $pdoClient->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            throw new Exception("Erreur pendant la requête $sql: {$e->getMessage()}");
        }
        return $statement;
    }
}