<?php
include("config.php");
include("Essay.php");
session_start();
$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$essay = Essay::getEssayById($conn, $_GET["id"]);
$grade = Essay::grade($conn, $_SESSION["user_id"], $_GET["id"]);
$conn = null;
?>
<html>
<head>
<title>Преглед на реферат</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<div class="page-header">
<h1>Преглед на реферат</h1>
</div>
<div class="row">
<div class="col-md-4">
<label for="author">Автор</label>
<input class="form-control" value="<?php echo $essay->user->firstName . " " . $essay->user->lastName ?>" disabled />
</div>
<div class="col-md-4">
<label for="author">Дата на качване</label>
<input class="form-control" type="date" value="<?php echo $essay->upload_date ?>" disabled />
</div>
</div>
<div class="row">
<div class="col-md-8">
<label for="title">Тема на реферата</label>
<input id="title" class="form-control" disabled value="<?php echo $essay->title ?>" />
</div>
<div class="col-md-8">
<label for="essay">Реферат</label>
<textarea id="essay" rows="30" class="form-control" disabled><?php echo $essay->content ?></textarea>
</div>
</div>
<div class="row">
<div class="col-md-8">
<label for="notes">Бележки</label>
<textarea name="notes" id="notes" class="form-control" disabled><?php echo $essay->notes ?></textarea>
</div>
</div>
<div class="row">
<div class="col-md-3">
<label>Рейтинг: <span id="ratingText"><?php echo $essay->rating; ?></span> от 5</label>
<div class="progress">
  <div id="rating" class="progress-bar" style="width: <?php echo 20 * $essay->rating ?>%;"></div>
</div>
</div>
</div>
<?php
if (!isset($_GET["myEssay"])) {
	if ($grade != null) {
		echo "<span class=\"label label-default\">Вече сте гласували за този реферат с $grade.</span>";
	} else {
?>
<div class="row">
<div class="col-md-6">
<input name="grade" type="radio" value="1" />1
<input name="grade" type="radio" value="2" />2
<input name="grade" type="radio" value="3" />3
<input name="grade" type="radio" value="4" />4
<input name="grade" type="radio" value="5" />5
<a class="btn btn-default disabled" id="vote" href="#"><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a><span id="voteSuccess" class="label label-success hide">Вие гласувахте успешно!</span>
</div>
</div>
<?php
	}
}
?>
<div class="row">
<div class="col-md-1">
<?php if (isset($_GET["myEssay"])) { ?>
<a class="btn btn-default" href="myEssay.php">Назад</a>
<?php } else if(isset($_GET["teacher"])) { ?>
<a class="btn btn-default" href="studentList.php">Назад</a>
<?php } else { ?>
<a class="btn btn-default" href="essayList.php">Назад</a>
<?php } ?>
</div>
</div>
</div>
</body>
</html>
<script>
$("input[name=grade]").on("click", function() {
	$("#vote").removeClass("disabled");
});

$("#vote").on("click", function(e) {
	$.ajax({
		url: "vote.php?id=<?php echo $_GET["id"] ?>&grade=" + $("input[name=grade]:checked").val(),
		success: function(newRating) {
			$("#rating").css("width", 20 * newRating + "%");
			$("#ratingText").html(newRating);
			$("#vote").hide();
			$("#voteSuccess").removeClass("hide");
			$("input[name=grade]").attr("disabled", "disabled");
		}
	});
	e.preventDefault();
});
</script>