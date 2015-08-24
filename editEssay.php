<?php
include("config.php");
include("Essay.php");
include("Subject.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$essay = Essay::getEssayById($conn, $_GET["id"]);
$subjectList = Subject::getAllSubjects($conn);
$conn = null;
?>
<html>
<head>
<title>Редакция на реферат</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<div class="page-header">
<h1>Редакция на реферат</h1>
</div>
<form action="saveEssay.php" method="post">
<input type="hidden" name="id" value="<?php echo $essay->id ?>" />
<input type="hidden" name="old_content" value="<?php echo $essay->content; ?>" />
<div class="row">
<div class="col-md-8">
<label for="file">Тема на реферата</label>
<input name="title" id="title" value="<?php echo $essay->title ?>" class="form-control" readonly="readonly" />
</div>
</div>
<div class="row">
<div class="col-md-8">
<label for="essay">Реферат</label>
<textarea name="content" rows="30" class="form-control"><?php echo $essay->content ?></textarea>
</div>
</div>
<div class="row">
<div class="col-md-8">
<label for="notes">Бележки</label>
<textarea name="notes" id="notes" class="form-control"><?php echo $essay->notes ?></textarea>
</div>
</div>
<div class="row">
<div class="col-md-8">
<a href="myEssay.php" class="btn btn-default">Отказ</a>
<button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Запази</button>
</div>
</div>
<input type="hidden" name="old_version" value="<?php echo $essay->version ?>" />
</form>
</div>
</body>
</html>
<script>
$(function() {
	$("#myEssay").addClass("active");
});
</script>