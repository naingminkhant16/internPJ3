<?php
session_start();
if (empty($_GET) || empty($_SESSION['admin'])) {
    header("location: category.php");
    die();
}
require_once "../config/DB.php";
$id = $_GET['id'];
$del = new DB();
$success = $del->crud("DELETE FROM categories WHERE id=:id", [":id" => $id]);
if ($success) {
    header("location: category.php");
}
