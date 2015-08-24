<?php
include("config.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$stmt = $conn->prepare("update essay set votes_count = votes_count + 1, votes_sum = votes_sum + :grade where id = :id");
$stmt->bindParam(":id", $_GET["id"]);
$stmt->bindParam(":grade", $_GET["grade"]);
$stmt->execute();
$stmt = $conn->prepare("insert into user_vote(user_id, essay_id, grade) values(:user_id, :essay_id, :grade)");
$stmt->bindParam(":user_id", $_SESSION["user_id"]);
$stmt->bindParam(":essay_id", $_GET["id"]);
$stmt->bindParam(":grade", $_GET["grade"]);
$stmt->execute();
$stmt = $conn->prepare("select votes_sum, votes_count from essay where id = :id");
$stmt->bindParam(":id", $_GET["id"]);
$stmt->execute();
$data = $stmt->fetch();
$conn = null;
echo $data["votes_sum"] / $data["votes_count"];
?>