<?php

$pseudo = filter_input(INPUT_POST, 'pseudo');
$message = filter_input(INPUT_POST, 'message');

if($pseudo != null && strlen($pseudo) > 0 && $message != null & strlen($message) > 0)
{
    include 'db/minichat.php';
    $minichat = new minichat();
    $minichat->setMinichatData($pseudo, $message);
}

header('Location: minichat.html');
?>