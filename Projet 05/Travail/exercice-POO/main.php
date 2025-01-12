<?php
require_once "Command.php";

$command = new Command();

while (true) {
    $userInput = readline("Entrez votre commande : ");
    $command->exec($userInput);
}