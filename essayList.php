<?php
include("config.php");
include("Essay.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$essayList = Essay::getColleagueEssays($conn, $_SESSION["user_id"]);
$conn = null;
?>
<html>
<head>
<title>Реферати на колеги</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<div class="page-header">
<h1>Реферати на колеги</h1>
</div>
<?php
if ($essayList == null) {
	echo "Все още не са добавени реферати от други студенти.";
} else {
?>
<table class="table table-hover">
<tr>
<th>Тема на реферата</th>
<th>Студент</th>
<th>Преглед</th>
</tr>
<?php
	foreach ($essayList as $essay) {
		echo "<tr>";
		echo "<td>$essay->title</td>";
		$user = $essay->user;
		echo "<td>$user->firstName $user->lastName</td>";
		echo "<td><a href=\"viewEssay.php?id=$essay->id\" class=\"btn btn-primary viewEssay\"><span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span></button></td>";
		echo "</tr>";
	}
}
?>
</table>
</div>
</body>
</html>
<script>
$(function() {
	$("#essayList").addClass("active");
});
</script>