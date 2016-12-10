<?php

$pseudo = filter_input(INPUT_POST, 'pseudo');
$message = filter_input(INPUT_POST, 'message');

if($pseudo != null && strlen($pseudo) > 0 && $message != null & strlen($message) > 0)
{
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    } catch (Exception $ex) {
        die('Erreur : '.$ex->getMessage());
    }

    $query = $bdd->prepare('INSERT INTO minichat (pseudo, message) VALUES (?,?)');
    $query->execute(array($pseudo, $message));
}

header('Location: minichat.html');
?>