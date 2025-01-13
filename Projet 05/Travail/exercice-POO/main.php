<?php
/**
 * CLI application to manage a list of contacts
 * A contact has a name, an email and a phone number.
 * You can view, create, delete and modify a contact.
 */

require_once "Command.php";

$command = new Command();

while (true) {
    $userInput = readline("Entrez votre commande : ");
    $command->exec($userInput);
}