<?php
include("config.php");
include("Subject.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$subjectList = Subject::getAllSubjects($conn);
$conn = null;
?>
<html>
<head>
<title>Добавяне на реферат</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<div class="page-header">
<h1>Добавяне на реферат</h1>
</div>
<form action="saveEssay.php" method="post">
<div class="row">
<div class="col-md-8">
<label for="file">Тема на реферата</label>
<select name="title" id="title" class="form-control">
<option value=""></option>
<?php
foreach ($subjectList as $subject) {
	echo "<option>$subject->title</option>";
}
?>
</select>
</div>
</div>
<div class="row">
<div class="col-md-8">
<label for="essay">Реферат</label>
<textarea name="content" rows="30" class="form-control"></textarea>
</div>
</div>
<div class="row">
<div class="col-md-8">
<label for="notes">Бележки</label>
<textarea name="notes" id="notes" class="form-control"></textarea>
</div>
</div>
<div class="row">
<div class="col-md-8">
<a href="myEssay.php" class="btn btn-default">Отказ</a>
<button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Запази</button>
</div>
</div>
<input type="hidden" name="old_version" value="0" />
</form>
</div>
</body>
</html>
<script>
$(function() {
	$("#myEssay").addClass("active");
});
</script>