<?php
include("config.php");
include("User.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$studentList = User::getAllStudents($conn);
$conn = null;
?>
<html>
<head>
<title>Регистрирани студенти</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<div class="page-header">
<h1>Регистрирани студенти</h1>
</div>
<?php
if ($studentList == null) {
	echo "Все още не са регистрирани студенти.";
} else {
?>
<table class="table table-hover">
<tr>
<th>Студент</th>
<th>Факултетен номер</th>
<th>Реферат</th>
</tr>
<?php
	foreach ($studentList as $student) {
		echo "<tr>";
		echo "<td>$student->firstName $student->middleName $student->lastName</td>";
		echo "<td>$student->fn</td>";
		if ($student->essayId == null) {
			echo "<td><span class=\"col-md-5 label label-danger\">Не е предал</span></td>";
		} else {
			echo "<td><a href=\"viewEssay.php?id=$student->essayId&teacher=true\" class=\"col-md-5 btn btn-primary viewEssay\"><span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span> Преглед</button></td>";
		}
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
	$("#studentList").addClass("active");
});
</script>