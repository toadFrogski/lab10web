<?php
require_once __DIR__ . '/base_up.html';
require_once __DIR__ . '/../utils/dbconnect.php';
require_once __DIR__ . '/header.php';

if (isset($conn) && empty($conn)) {
    echo 'Error';
    exit;
}

$query = "select c.child_name, c.child_birth, p.parent_name from child c inner join parent p on p.parent_id = c.parent_id";
$parents = $conn->query($query)->fetch_all();
$table = "<section class=\"mx-auto w-75 mt-5 bg-light\"><h2 class=\"w-100 text-center py-3\">Дети</h2>";
$table .= "<div class=\"d-flex justify-content-around\">";
$table .= "<p class=\"w-25 text-center\"><b>Имя</b></p>";
$table .= "<p class=\"w-25 text-center\"><b>Дата рождения</b></p>";
$table .= "<p class=\"w-25 text-center\"><b>Родитель</b></p></div>";
foreach ($parents as $parent) {
    $table .= "<div class=\"d-flex justify-content-around\">";
    $table .= "<p class=\"w-25 text-center\">{$parent[0]}</p>";
    $table .= "<p class=\"w-25 text-center\">{$parent[1]}</p>";
    $table .= "<p class=\"w-25 text-center\">{$parent[2]}</p>";
    $table .= "</div>";
}
$table .= "</section>";
echo $table;

require_once __DIR__ . '/base_down.html';