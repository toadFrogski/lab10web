<?php
require_once __DIR__ . '/../utils/dbconnect.php';

$query = "DELETE FROM event WHERE event_id='{$_GET['event']}'";
$conn->query($query);

$conn->close();
header('Location: /');