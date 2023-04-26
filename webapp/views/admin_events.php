<?php

require_once __DIR__ . '/base_up.html';
require_once __DIR__ . '/../utils/dbconnect.php';
require_once __DIR__ . '/header.php';

if (isset($conn) && empty($conn)) {
    echo 'Error';
    exit;
}

$query = "select e.event_name, e.event_location, e.event_price, m.manager_login, e.event_id from event e inner join manager m on e.manager_id = m.manager_id";
$events = $conn->query($query)->fetch_all();
$table = "<section class=\"mx-auto w-75 mt-5 bg-light\"><h2 class=\"w-100 text-center py-3\">События</h2>";
$table .= "<div class=\"d-flex justify-content-around\">";
$table .= "<p class=\"w-25 text-center\"><b>Событие</b></p>";
$table .= "<p class=\"w-25 text-center\"><b>Локация</b></p>";
$table .= "<p class=\"w-25 text-center\"><b>Цена</b></p>";
$table .= "<p class=\"w-25 text-center\"><b>Связаться</b></p>";
$table .= "</div>";
foreach ($events as $event) {
    $table .= "<div class=\"d-flex justify-content-around\">";
    $table .= "<p class=\"w-25 text-center\">{$event[0]}</p>";
    $table .= "<p class=\"w-25 text-center\">{$event[1]}</p>";
    $table .= "<p class=\"w-25 text-center\">{$event[2]}</p>";
    $table .= "<p class=\"w-25 text-center\">{$event[3]}</p>";
    $table .= "<a href=\"record_edit?event={$event[4]}\"><img width=30 src=\"../static/assets/edit.svg\"></a>";
    $table .= "<a href=\"record_delete?event={$event[4]}\"><img width=30 src=\"../static/assets/delete.svg\"></a>";
    $table .= "</div>";
}
$table .= "<a class=\"text-center\" href=\"record_new\"><img width=30 src=\"../static/assets/record.svg\"></a>";
$table .= "</section>";
echo $table;

require_once __DIR__ . '/base_down.html';