<?php
include("config.php");
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$stmt = $conn->prepare("delete from subject where id = :id");
$stmt->bindParam(":id", $_GET["id"]);
$stmt->execute();
$conn = null;
header("Location: subjectList.php?deleteSuccess=true");
?>