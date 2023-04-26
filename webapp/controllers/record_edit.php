<?php
require_once __DIR__ . '/../utils/dbconnect.php';
session_start();

$query = "UPDATE event set event_name='{$_POST['name']}', manager_id='{$_POST['manager']}', event_location='{$_POST['location']}', event_price='{$_POST['price']}' where event_id='{$_POST['event_id']}'";
$conn->query($query);

$conn->close();
header('Location: /');