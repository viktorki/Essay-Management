<html>
<head>
<title>������</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location: login.php");
}
include("menu.php");
?>
</body>
</html>