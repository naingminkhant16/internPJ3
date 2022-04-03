<?php
if (empty($_GET)) {
    header("location: mail.php");
}
require "../config/DB.php";
$id = $_GET['id'];
$db = new DB();
$query = "DELETE FROM mails WHERE id=:id";
$data = [
    ":id" => $id
];
$result = $db->crud($query, $data);
if ($result) {
    echo "<script>alert('Successfully deleted mail.');window.location.href='mail.php'</script>";
}
