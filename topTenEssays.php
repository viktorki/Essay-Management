<?php
include("config.php");
include("Essay.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$essayList = Essay::getTopTenEssays($conn);
$conn = null;
?>
<html>
<head>
<title>��� 10 ��������</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<div class="page-header">
<h1>��� 10 ��������</h1>
</div>
<table class="table table-hover">
<tr>
<th>���� �� ��������</th>
<th>�������</th>
<th>�������</th>
</tr>
<?php
if ($essayList != null) {
	foreach ($essayList as $essay) {
		echo "<tr class=\"essay\">";
		echo "<td>$essay->title</td>";
		$user = $essay->user;
		echo "<td>$user->firstName $user->lastName</td>";
		echo "<td>$essay->rating</td>";
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
	$("#toptenessays").addClass("active");
	$(".essay:first").addClass("success");
});
</script>