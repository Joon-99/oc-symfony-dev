<?php
require_once "DBConnect.php";
require_once "ContactManager.php";
require_once "Contact.php";
require_once "Command.php";

$command = new Command();

while (true) {
    $userInput = readline("Entrez votre commande : ");
    $command->exec($userInput);
}