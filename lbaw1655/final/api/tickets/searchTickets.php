<?php
include_once('../../database/tickets.php');

if(!isset($_SESSION["iduser"])){
    $_SESSION['error_messages'][] = 'User without permissions to proceed.';
    header('Location: ../../index.php');
    die();
}

if (!isset($_GET["offset"]) ){
    $_SESSION['error_messages'][] = 'Error receiving search arguments.';
    header('Location: ../../index.php');
    die();
}

$offset = trim(strip_tags($_GET["offset"]));

if(!isset($_GET["solved"])) {
    $ticketArray = getAllTickets($_SESSION["iduser"],$offset);
}
else{
    $solved = trim(strip_tags($_GET["solved"]));
    $ticketArray = getUserTickets($_SESSION["iduser"], $solved,$offset);
}

echo json_encode($ticketArray);