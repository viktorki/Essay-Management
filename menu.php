<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">������� �� ��������</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php if ($_SESSION["role"] == 1) { ?>
        <li id="myEssay"><a href="myEssay.php">���� �������</a></li>
        <li id="essayList"><a href="essayList.php">�������� �� ������</a></li>
      <?php } else { ?>
        <li id="subjects"><a href="subjectList.php">���� �� ��������</a></li>
        <li id="studentList"><a href="studentList.php">������������ ��������</a></li>
      <?php } ?>
      	<li id="toptenessays"><a href="topTenEssays.php">��� 10 ��������</a></li>
        <li id="profile"><a href="profile.php">������</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li class="navbar-text">��� ��� ������ ���� <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> �����</a></li>
      </ul>
    </div>
  </div>
</nav>