<?php
require 'functions.php';

if(empty($_GET['user-location-id']) || empty($_GET['note'])) {
    http_response_code(400);

    exit;
}

$pdo = getPdo();

$userLocationId = sanitize($_GET['user-location-id']);
$note = sanitize($_GET['note']);

addNote($pdo, $userLocationId, $note);