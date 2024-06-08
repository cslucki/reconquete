<?php
require 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

$filename = 'data.yaml';

function readRecords($filename) {
    return Yaml::parseFile($filename);
}

$allRecords = readRecords($filename);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 10;
$totalRecords = count($allRecords);
$totalPages = ceil($totalRecords / $perPage);
$start = ($page - 1) * $perPage;
$records = array_slice($allRecords, $start, $perPage);

header('Content-Type: application/json');
echo json_encode([
    'records' => $records,
    'totalPages' => $totalPages
]);