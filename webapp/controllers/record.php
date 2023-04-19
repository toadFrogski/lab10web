<?php
require_once __DIR__ . '/../utils/dbconnect.php';
$query = "SELECT parent_id from parent where parent_name='{$_POST['name']}' and parent_email = '{$_POST['email']}'";
$parent_id = $conn->query($query)->fetch_all();
if (empty($parent_id)) {
    $query = "INSERT into parent(parent_name, parent_email) values('{$_POST['name']}', '{$_POST['email']}')";
    $conn->query($query);
    $query = "SELECT parent_id from parent where parent_name='{$_POST['name']}' and parent_email = '{$_POST['email']}'";
    $parent_id = $conn->query($query)->fetch_all();
}
$query = "SELECT child_id from child where child_name = '{$_POST['child_name']}' and child_birth = '{$_POST['date']}' and parent_id = '" . (int) $parent_id[0] . "'";
$child_id = $conn->query($query)->fetch_all();
if (empty($child_id)) {
    $query = "INSERT into child(child_name, child_birth, parent_id) values('{$_POST['child_name']}', '{$_POST['date']}', '" . (int) $parent_id[0] . "')";
    $conn->query($query);
}
$conn->close();
header('Location: /');