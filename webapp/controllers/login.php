<?php
require_once __DIR__ . '/../utils/dbconnect.php';
session_start();

$query = "SELECT * from manager";
$managers = $conn->query($query)->fetch_all();
$test = 'asdad';
if (in_array($_POST['email'], array_column($managers, 1)) 
    && in_array(md5($_POST['password']), array_column($managers, 2))) {
    $_SESSION['role'] = 'manager';
}
$conn->close();
header('Location: /');