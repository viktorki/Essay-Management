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
<title>Теми за реферати</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<?php
if (isset($_GET["addSuccess"])) {
?>
<div class="alert alert-success">Темата беше добавена успешно!</div>
<?php
}
if (isset($_GET["deleteSuccess"])) {
?>
<div class="alert alert-success">Темата беше изтрита успешно!</div>
<?php } ?>
<div class="page-header">
<h1>Теми за реферати</h1>
</div>
<?php if ($subjectList != null) { ?>
<table class="table">
<tr>
<th>Тема</th>
<th>Изтриване</th>
</tr>
<tr>
<?php
	foreach ($subjectList as $subject) {
		echo "<tr>";
		echo "<td>$subject->title</td>";
		echo "<td><a href=\"deleteSubject.php?id=$subject->id\" class=\"btn btn-danger deleteSubject\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></button></td>";
		echo "</tr>";
	}
}
?>
</tr>
</table>
<a href="#" id="addSubject" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавяне на тема за реферат</a>
</div>
<div id="addSubjectModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Отказ"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Добавяне на тема за реферат</h4>
      </div>
      <div class="modal-body">
      	<form id="form" action="saveSubject.php" method="post">
        	<label for="subject">Тема</label>
        	<input name="subject" id="subject" class="form-control" required  />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Отказ</button>
        <button id="submit" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Запази</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
$(function() {
	$("#subjects").addClass("active");
});

$(".deleteSubject").on("click", function(e) {
	if (!confirm("Сигурни ли сте, че искате да изтриете темата?")) {
		e.preventDefault();
	}
});

$("#addSubject").on("click", function() {
	$("#addSubjectModal").modal("show");
});

$("#submit").on("click", function() {
	$("#form").submit();
});
</script>