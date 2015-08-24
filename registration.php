<?php
include("constants.php");
?>
<html>
<head>
<title>Регистрация</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<div class="container">
<?php if (isset($_GET["usernameNotUnique"])) { ?>
<div class="alert alert-danger">Вече съществува потребител с въведеното потребителско име!</div>
<?php } ?>
<div class="page-header">
<h1>Регистрация</h1>
</div>
<form action="createUser.php" method="post" id="form">
<fieldset>
<div class="row">
<div class="col-md-3">
<label>Потребителско име</label>
<input name="username" class="form-control" required />
</div>
<div class="col-md-3">
<label>Парола</label>
<input type="password" name="password" id="password" class="form-control" required />
<span id="passwordsDoesNotMatch" class="help-block hide">Паролите не съвпадат!</span>
</div>
<div class="col-md-3">
<label>Повтори паролата</label>
<input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
</div>
<div class="col-md-3">
<label>Роля</label>
<select name="role" id="role" class="form-control">
<option value="1"><?php echo STUDENT ?></option>
<option value="2"><?php echo TEACHER ?></option>
</select>
</div>
</div>
</fieldset>
<fieldset>
<legend>Лични данни</legend>
<div class="row">
<div class="col-md-3">
<label for="first_name">Име</label>
<input name="first_name" id="first_name" class="form-control" required />
</div>
<div class="col-md-3">
<label for="middle_name">Презиме</label>
<input name="middle_name" id="middle_name" class="form-control" required />
</div>
<div class="col-md-3">
<label for="last_name">Фамилия</label>
<input name="last_name" id="last_name" class="form-control" required />
</div>
</div>
<div class="row">
<div class="col-md-3 student">
<label for="fn">Факултетен номер</label>
<input name="fn" id="fn" class="form-control" />
</div>
</div>
<div class="row">
<a class="btn btn-default" href="login.php">Отказ</a>
<button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Запази</button>
</div>
</fieldset>
</form>
</div>
</body>
</html>
<script>
$("#role").on("change", function() {
	if ($(this).val() == 1) {
		$(".student").show();
	} else {
		$(".student").hide();
	}
});

$("#form").on("submit", function(e) {
	if ($("#password").val() != $("#confirm_password").val()) {
		$("#password").parent().addClass("has-error");
		$("#confirm_password").parent().addClass("has-error");
		$("#passwordsDoesNotMatch").removeClass("hide");
		e.preventDefault();
	}
});
</script>