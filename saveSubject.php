<?php
include("config.php");
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$stmt = $conn->prepare("insert into subject(title) values(:title)");
$stmt->bindParam(":title", $_POST["subject"]);
$stmt->execute();
$conn = null;
header("Location: subjectList.php?addSuccess=true");
?>