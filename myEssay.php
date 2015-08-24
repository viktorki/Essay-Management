<?php
include("config.php");
include("Essay.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$essayList = Essay::getEssaysByAuthor($conn, $_SESSION["user_id"]);
$conn = null;
?>
<html>
<head>
<title>���� �������</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<div class="page-header">
<h1>���� �������</h1>
</div>
<?php
if ($essayList != null) {
	$currentVersion = $essayList[0];
	array_shift($essayList);
?>
<fieldset>
<legend>������ ������</legend>
<table class="table">
<tr>
<th>������</th>
<th>���� �� �������</th>
<th>�������</th>
<th>��������</th>
</tr>
<tr>
<?php
	echo "<td>$currentVersion->version</td>";
	echo "<td>$currentVersion->upload_date</td>";
	echo "<td><a href=\"viewEssay.php?id=$currentVersion->id&myEssay=true\" class=\"btn btn-primary viewEssay\"><span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span></button></td>";
	echo "<td><a href=\"editEssay.php?id=$currentVersion->id\" class=\"btn btn-primary editEssay\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></button></td>";
?>
</tr>
</table>
</fieldset>
<?php if ($essayList != null) { ?>
<fieldset>
<legend>����� ������</legend>
<table class="table">
<tr>
<th>������</th>
<th>���� �� �������</th>
<th>�������</th>
</tr>
<?php
		foreach ($essayList as $essay) {
			echo "<tr>";
			echo "<td>$essay->version</td>";
			echo "<td>$essay->upload_date</td>";
			echo "<td><a href=\"viewEssay.php?id=$essay->id&myEssay=true\" class=\"btn btn-primary viewEssay\"><span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span></button></td>";
			echo "</tr>";
		}
	}
} else {
?>
��� ��� �� ��� �������� �������.
<br />
<a href="newEssay.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> �������� �� �������</a>
<?php } ?>
</table>
</fieldset>
</div>
</body>
</html>
<script>
$(function() {
	$("#myEssay").addClass("active");
});
</script>