<?php
include("config.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
if ($_POST["old_content"] == $_POST["content"]) {
	$stmt = $conn->prepare("update essay set notes = :notes where id = :id");
	$stmt->bindParam(":notes", $_POST["notes"]);
	$stmt->bindParam(":id", $_POST["id"]);
	$stmt->execute();
} else {
	$new_version = $_POST["old_version"] + 1;
	$stmt = $conn->prepare("insert into essay(title, content, notes, user_id, upload_date, version) values(:title, :content, :notes, :user_id, :upload_date, :version)");
	$stmt->bindParam(":title", $_POST["title"]);
	$stmt->bindParam(":content", $_POST["content"]);
	$stmt->bindParam(":notes", $_POST["notes"]);
	$stmt->bindParam(":user_id", $_SESSION["user_id"]);
	$stmt->bindParam(":upload_date", date("Y-m-d"));
	$stmt->bindParam(":version", $new_version);
	$stmt->execute();
}
$conn = null;
header("Location: myEssay.php");
?>