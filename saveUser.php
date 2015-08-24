<?php
include("config.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$stmt = $conn->prepare("update user set first_name = :first_name, middle_name = :middle_name, last_name = :last_name, fn = :fn where id = :id");
$stmt->bindParam(":first_name", $_POST["first_name"]);
$stmt->bindParam(":middle_name", $_POST["middle_name"]);
$stmt->bindParam(":last_name", $_POST["last_name"]);
$stmt->bindParam(":fn", $_POST["fn"]);
$stmt->bindParam(":id", $_SESSION["user_id"]);
$stmt->execute();
$conn = null;
header("Location: profile.php?updateSuccess=true");
?>