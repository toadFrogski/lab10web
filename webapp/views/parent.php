<?php
require_once __DIR__ . '/base_up.html';
require_once __DIR__ . '/../utils/dbconnect.php';
require_once __DIR__ . '/header.php';

if (isset($conn) && empty($conn)) {
    echo 'Error';
    exit;
}

$query = "select parent_name, parent_email from parent";
$parents = $conn->query($query)->fetch_all();
$table = "<section class=\"mx-auto w-75 mt-5 bg-light\"><h2 class=\"w-100 text-center py-3\">Родители</h2>";
$table .= "<div class=\"d-flex justify-content-around\">";
$table .= "<p class=\"w-25 text-center\"><b>Имя</b></p>";
$table .= "<p class=\"w-25 text-center\"><b>Почта</b></p></div>";
foreach ($parents as $parent) {
    $table .= "<div class=\"d-flex justify-content-around\">";
    $table .= "<p class=\"w-25 text-center\">{$parent[0]}</p>";
    $table .= "<p class=\"w-25 text-center\">{$parent[1]}</p>";
    $table .= "</div>";
}
$table .= "</section>";
echo $table;

require_once __DIR__ . '/base_down.html';