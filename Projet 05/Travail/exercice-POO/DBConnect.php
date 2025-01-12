<?php

class DBConnect {
    private string $DB_HOST = "localhost";
    private string $DB_NAME = "exercise-p05";
    private string $DB_USER = "root";
    private string $DB_PASSWORD = "";
    private string $DB_CONNECTION_CHARSET = "utf8mb4";

    // watch out, php doesn't throw anything if you send a named parameter with a typo
    private string $DB_CONNECT_STR;
    
    private PDO $pdoInstance;

    public function __construct() {
        $this->DB_CONNECT_STR = "mysql:host={$this->DB_HOST};dbname={$this->DB_NAME};charset={$this->DB_CONNECTION_CHARSET};";
    }

    public function getPDO() : ?PDO {
        try {
            $pdoClient = new PDO(
                $this->DB_CONNECT_STR,
                $this->DB_USER,
                $this->DB_PASSWORD,
            );
        } catch (Exception $e) {
            return null;
        }
        return $pdoClient;
    }

    public function execQuery(PDO $pdoClient, $sql, $parameters = []) : PDOStatement {
        try {
            $statement = $pdoClient->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            throw new Exception("Erreur pendant la requête $sql: {$e->getMessage()}");
        }
        return $statement;
    }
}