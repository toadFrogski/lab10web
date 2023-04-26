<?php
require_once __DIR__ . '/../utils/dbconnect.php';
session_start();

$query = "INSERT into event(event_name, manager_id, event_location, event_price) values('{$_POST['name']}', '{$_POST['manager']}', '{$_POST['location']}', '{$_POST['price']}')";
$conn->query($query);

$conn->close();
header('Location: /');