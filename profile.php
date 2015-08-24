<?php
include("config.php");
include("User.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$user = User::getUserById($conn, $_SESSION["user_id"]);
$conn = null;
?>
<html>
<head>
<title>Профил</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<?php if (isset($_GET["updateSuccess"])) { ?>
<div class="alert alert-success">Данните бяха обновени успешно!</div>
<?php } ?>
<div class="page-header">
<h1>Профил</h1>
</div>
<form action="saveUser.php" method="post">
<fieldset>
<div class="row">
<div class="col-md-3">
<label>Потребителско име</label>
<input value="<?php echo $user->username ?>" class="form-control" disabled="disabled" />
</div>
<div class="col-md-3">
<label>Роля</label>
<input value="<?php echo $user->role == 1 ? STUDENT : TEACHER ?>" class="form-control" disabled="disabled" />
</div>
</div>
</fieldset>
<fieldset>
<legend>Лични данни</legend>
<div class="row">
<div class="col-md-3">
<label for="first_name">Име</label>
<input value="<?php echo $user->firstName ?>" name="first_name" id="first_name" class="form-control" required />
</div>
<div class="col-md-3">
<label for="middle_name">Презиме</label>
<input value="<?php echo $user->middleName ?>" name="middle_name" id="middle_name" class="form-control" required />
</div>
<div class="col-md-3">
<label for="last_name">Фамилия</label>
<input value="<?php echo $user->lastName ?>" name="last_name" id="last_name" class="form-control" required />
</div>
</div>
<div class="row">
<div class="col-md-3">
<?php if ($user->role == 1) { ?>
<label for="fn">Факултетен номер</label>
<input value="<?php echo $user->fn ?>" name="fn" id="fn" class="form-control" />
<?php } ?>
</div>
</div>
<div class="row">
<div class="col-md-9">
<button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Запази</button>
</div>
</div>
</fieldset>
</form>
</div>
</body>
</html>
<script>
$(function() {
	$("#profile").addClass("active");
});
</script>