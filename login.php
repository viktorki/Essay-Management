<?php
if (isset($_POST["submit"])) {
	include("config.php");
	$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
	$stmt = $conn->prepare("select id, password, first_name, last_name, role from user where username = ?");
	$stmt->bindParam(":username", $_POST["username"]);
	if ($stmt->execute(array($_POST["username"]))) {
		$data = $stmt->fetch();
		if (sha1($_POST["password"]) == $data["password"]) {
			session_start();
			$_SESSION["user_id"] = $data["id"];
			$_SESSION["first_name"] = $data["first_name"];
			$_SESSION["last_name"] = $data["last_name"];
			$_SESSION["role"] = $data["role"];
			header("Location: index.php");
		}
	}
	$conn = null;
	$loginFailed = true;
}
?>
<html>
<head>
<title>Вход</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<form action="login.php" method="post">
<div class="container">
<?php if (isset($_GET["registrationSuccess"])) { ?>
<div class="alert alert-success">Успешно се регистрирахте в системата! Можете да влезете в профила си.</div>
<?php
}
if (isset($loginFailed)) {
?>
<div class="alert alert-danger">Грешно потребителско име или парола!</div>
<?php } ?>
<div class="row">
<div class="col-md-2 col-md-offset-4"><label for="username">Потребителско име</label></div>
<div class="col-md-2"><input name="username" id="username" class="form-control" required /></div>
</div>
<div class="row">
<div class="col-md-2 col-md-offset-4"><label for="password">Парола</label></div>
<div class="col-md-2"><input type="password" name="password" id="password" class="form-control" required /></div>
</div>
<div class="row">
<div class="col-md-4 col-md-offset-4">
<a href="registration.php">Регистрация</a>
<button class="btn btn-primary pull-right" name="submit" type="submit"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Вход</button>
</div>
</div>
</div>
</form>
</body>
</html>