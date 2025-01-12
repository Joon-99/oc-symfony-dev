<?php

require_once "ContactManager.php";
class Command {
    private const PATTERN_COMMAND_LIST = '/list/';
    private const PATTERN_COMMAND_DETAIL = '/detail ([0-9]+)/';
    private const PATTERN_COMMAND_CREATE = '/^create ([A-Za-z -]{1,100}),([A-Za-z\.@-]{1,150}),([0-9]{1,50})$/';
    private const PATTERN_COMMAND_DELETE = '/delete ([0-9]+)/';
    private const PATTERN_COMMAND_MODIFY = '/^modify ([0-9]+),([A-Za-z -]{1,100}),([A-Za-z\.@-]{1,150}),([0-9]{1,50})$/';
    private const PATTERN_COMMAND_HELP = '/help/';
    private const PATTERN_COMMAND_EXIT = '/exit/';
    private ContactManager $contactManager;

    public function __construct() {
        $this->contactManager = new ContactManager();
    }
    public function exec($input) : void {
        $commandNames = [
            'list',
            'detail <id>',
            'create <name>,<email>,<phone_number>',
            'delete <id>',
            'modify <id>,<name>,<email>,<phone_number>',
            'help',
            'exit',
        ];
        $matches = [];
        switch (true) {
            case preg_match(self::PATTERN_COMMAND_LIST, $input):
                $this->list();
                break;
            case preg_match(self::PATTERN_COMMAND_DETAIL, $input, $matches):
                $this->detail($matches[1]);
                break;
            case preg_match(self::PATTERN_COMMAND_CREATE, $input, $matches):
                $this->create($matches[1], $matches[2], $matches[3]);
                break;
            case preg_match(self::PATTERN_COMMAND_DELETE, $input, $matches):
                $this->delete($matches[1]);
                break;
            case preg_match(self::PATTERN_COMMAND_MODIFY, $input, $matches):
                $this->modify($matches[1], $matches[2], $matches[3], $matches[4]);
                break;
            case preg_match(self::PATTERN_COMMAND_HELP, $input):
                echo "Make sure the following constraints are respected: " . PHP_EOL;
                echo "- <id> must exist in the database" . PHP_EOL;
                echo "- <name> must not exceed 100 characters, and can contain only these caracters: A-Z, a-z, -, and (space)" . PHP_EOL;
                echo "- <email> must not exceed 150 characters, and can contain only these caracters: A-Z, a-z, -, . and @" . PHP_EOL;
                echo "- <phone_number> must not exceed 50 characters and can contain only these caracters: 0-9" . PHP_EOL;
                break;
            case preg_match(self::PATTERN_COMMAND_EXIT, $input):
                exit(0);
            default:
                echo "Commande inconnue ou syntaxe incorrecte. Commandes disponibles :" . PHP_EOL;
                foreach ($commandNames as $cmd) {
                    echo "- $cmd" . PHP_EOL;
                }
        }
    }
    public function list() : void {
        $contactList = $this->contactManager->findAll();
        $listCorner = '**';
        $listVEdgeLeft = '| ';
        $listVEdgeRight = ' |';
        $listFillChar = '-';
        $maxLength = max(array_map('mb_strlen', $contactList));
        echo $listCorner . str_repeat($listFillChar, $maxLength) . $listCorner . PHP_EOL;
        foreach ($contactList as $contact) {
            $length = mb_strlen($contact);
            $padding = $maxLength - $length;
            echo $listVEdgeLeft . $contact . str_repeat(' ', $padding) . $listVEdgeRight . PHP_EOL;
        }
        echo $listCorner . str_repeat($listFillChar, $maxLength) . $listCorner . PHP_EOL;
    }
    public function detail(string $id): void {
        $contactToExamine = $this->contactManager->findById($id);
        if ($contactToExamine) {
            echo $contactToExamine;
        }
        else { 
            echo "No contact found with the id: $id" . PHP_EOL;
        }
    }
    public function create(string $name, string $email, string $phoneNumber): void {
        $result = $this->contactManager->createContact($name, $email, $phoneNumber);
        if ($result) {
            echo "Contact created successfully." . PHP_EOL;
        } else {
            echo "Failure to create the contact." . PHP_EOL;
        }
    }
    public function delete(string $id): void {
        $result = $this->contactManager->deleteContact($id);
        if ($result) {
            echo "Contact deleted successfully." . PHP_EOL;
        } else {
            echo "Failure to delete the contact." . PHP_EOL;
        }
    }
    public function modify(string $id, string $name, string $email, string $phoneNumber) : void {
        $result = $this->contactManager->modifyContact($id, $name, $email, $phoneNumber);
        if ($result) {
            echo "Contact modified successfully." . PHP_EOL;
        } else {
            echo "Failure to modify the contact." . PHP_EOL;
        }
    }
}