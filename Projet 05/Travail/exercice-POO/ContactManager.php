<?php
require_once "DBConnect.php";
require_once "Contact.php";
class ContactManager {
    private DBConnect $dbUnit;
    private PDO $pdoClient;

    public function __construct() {
        $this->dbUnit = new DBConnect();
        $this->pdoClient = $this->dbUnit->getPDO();
    }

    public function findAll() : ?array {
        $sql = <<<SQL
            SELECT * FROM contact;
        SQL;
        try {
            $pdoStatement = $this->dbUnit->execQuery($this->pdoClient, $sql);
        } catch (Exception $e) {
            echo "{$e->getMessage()}" . PHP_EOL;
            return null;
        }
        $contactList = [];
        foreach ($pdoStatement as $row) {
            $contact = new Contact($row['id'], $row['name'], $row['email'], $row['phone_number']);
            $contactList[] = $contact;
        }
        return $contactList;
    }
    public function findById(string $idToFind) : ?Contact {
        $sql = <<<SQL
            SELECT * FROM contact
            WHERE id = :id;
        SQL;
        $parameters = ['id' => $idToFind];
        try {
            $pdoStatement = $this->dbUnit->execQuery($this->pdoClient, $sql, $parameters);
        } catch (Exception $e) {
            echo "{$e->getMessage()}" . PHP_EOL;
            return null;
        }
        $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Contact($result['id'], $result['name'], $result['email'], $result['phone_number']);
        }
        else {
            return null;
        }
    }
    public function createContact(string $name, string $email, string $phoneNumber) : bool {
        $sql = <<<SQL
            INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phoneNumber);
        SQL;
        $parameters = [
            'name' => $name,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
        ];
        try {
            $pdoStatement = $this->dbUnit->execQuery($this->pdoClient, $sql, $parameters);
        } catch (Exception $e) {
            echo "{$e->getMessage()}" . PHP_EOL;
            return false;
        }
        return true;
    }

    public function deleteContact(string $id) : bool {
        $sql = <<<SQL
            DELETE FROM contact WHERE id = :id;
        SQL;
        $parameters = ['id' => $id];
        try {
            $pdoStatement = $this->dbUnit->execQuery($this->pdoClient, $sql, $parameters);
        } catch (Exception $e) {
            echo "{$e->getMessage()}" . PHP_EOL;
            return false;
        }
        return $pdoStatement->rowCount() > 0;
    }

    public function modifyContact(string $id, string $name, string $email, string $phoneNumber) : bool {
        $sql = <<<SQL
            UPDATE contact
            SET name = :name, email = :email, phone_number = :phoneNumber
            WHERE id = :id;
        SQL;
        $parameters = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
        ];
        try {
            $pdoStatement = $this->dbUnit->execQuery($this->pdoClient, $sql, $parameters);
        } catch (Exception $e) {
            echo "{$e->getMessage()}" . PHP_EOL;
            return false;
        }
        return $pdoStatement->rowCount() > 0;
    }
}