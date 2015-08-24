<?php
include("config.php");
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$stmt = $conn->prepare("select count(*) from user where username = :username");
$stmt->bindParam(":username", $_POST["username"]);
$stmt->execute();
$count = $stmt->fetch()[0];
if($count == 0) {
	$stmt = $conn->prepare("insert into user(username, password, first_name, middle_name, last_name, role, fn) values(:username, :password, :first_name, :middle_name, :last_name, :role, :fn)");
	$stmt->bindParam(":username", $_POST["username"]);
	$stmt->bindParam(":password", sha1($_POST["password"]));
	$stmt->bindParam(":first_name", $_POST["first_name"]);
	$stmt->bindParam(":middle_name", $_POST["middle_name"]);
	$stmt->bindParam(":last_name", $_POST["last_name"]);
	$stmt->bindParam(":role", $_POST["role"]);
	if ($_POST["role"] == 1) {
		$fn = $_POST["fn"];
	} else {
		$fn = null;
	}
	$stmt->bindParam(":fn", $fn);
	$stmt->execute();
	$conn = null;
	header("Location: login.php?registrationSuccess=true");
} else {
	header("Location: registration.php?usernameNotUnique=true");
}
?>