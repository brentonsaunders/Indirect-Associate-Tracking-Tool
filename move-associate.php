<?php
require 'functions.php';

if(empty($_GET['associate-id']) || empty($_GET['location-id'])) {
    http_response_code(400);

    exit;
}

$pdo = getPdo();

$associateId = $_GET['associate-id'];
$locationId = $_GET['location-id'];

if(($location = getLocation($pdo, $locationId)) === null) {
    http_response_code(400);

    exit;
}

$userLocationId = moveAssociateToLocation($pdo, $associateId, $locationId);

header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'location-name' => $location['name'],
    'time' => date('h:i A'),
    'user-location-id' => $userLocationId
]);