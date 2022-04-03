<?php
if (empty($_GET)) {
    header("location: mail.php");
}
require "../config/DB.php";
$id = $_GET['id'];
$db = new DB();
$query = "UPDATE mails SET is_read=:read WHERE id=:id";
$data = [
    ":read" => 1,
    ":id" => $id
];
$result = $db->crud($query, $data);
if ($result) {
    header("location: mail.php");
}
