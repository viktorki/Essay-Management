<?php
include("User.php");

class Essay {
	private $id;
	private $title;
	private $content;
	private $notes;
	private $user;
	private $rating;
	private $upload_date;
	private $version;
	
	function __construct($id, $title, $content, $notes, $user, $rating, $upload_date, $version) {
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;
		$this->notes = $notes;
		$this->user = $user;
		$this->rating = $rating;
		$this->upload_date = $upload_date;
		$this->version = $version;
	}
	
	function __get($property) {
		return $this->$property;
	}
	
	public static function getEssayById($conn, $id) {
		$sql = "select * from essay e join user u on e.user_id = u.id where e.id = $id";
		$query = $conn->query($sql);
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$user = new User($data["username"], $data["first_name"], $data["middle_name"], $data["last_name"], $data["role"], $data["fn"], null);
		if ($data["votes_count"] == 0) {
			$rating = 0;
		} else {
			$rating = round($data["votes_sum"] / $data["votes_count"], 2);
		}
		
		return new Essay($id, $data["title"], $data["content"], $data["notes"], $user, $rating, $data["upload_date"], $data["version"]);
	}
	
	public static function getColleagueEssays($conn, $author_id) {
		$sql = "select e.id, title, username, first_name, middle_name, last_name, role, fn, votes_count, votes_sum from essay e join user u on e.user_id = u.id where user_id <> $author_id and version = (select max(version) from essay e2 where e2.user_id = e.user_id)";
		$query = $conn->query($sql);
		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$user = new User($data["username"], $data["first_name"], $data["middle_name"], $data["last_name"], $data["role"], $data["fn"], null);
			if ($data["votes_count"] == 0) {
				$rating = 0;
			} else {
				$rating = round($data["votes_sum"] / $data["votes_count"], 2);
			}
			$essayList[] = new Essay($data["id"], $data["title"], null, null,  $user, $rating, null, null);
		}
		
		if (isset($essayList))
			return $essayList;
		
		return null;
	}
	
	public static function getEssaysByAuthor($conn, $author_id) {
		$sql = "select id, version, title, upload_date from essay where user_id = $author_id order by version desc";
		$query = $conn->query($sql);
		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$essayList[] = new Essay($data["id"], $data["title"], null, null, null, null, $data["upload_date"], $data["version"]);
		}
		
		if (isset($essayList))
			return $essayList;
		
		return null;
	}
	
	public static function getTopTenEssays($conn) {
		$sql = "select e.id, title, username, first_name, middle_name, last_name, role, fn, votes_count, votes_sum from essay e join user u on e.user_id = u.id where version = (select max(version) from essay e2 where e2.user_id = e.user_id) order by votes_sum / votes_count desc limit 10";
		$query = $conn->query($sql);
		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$user = new User($data["username"], $data["first_name"], $data["middle_name"], $data["last_name"], $data["role"], $data["fn"], null);
			if ($data["votes_count"] == 0) {
				$rating = 0;
			} else {
				$rating = round($data["votes_sum"] / $data["votes_count"], 2);
			}
			$essayList[] = new Essay($data["id"], $data["title"], null, null,  $user, $rating, null, null);
		}
	
		if (isset($essayList))
			return $essayList;
	
		return null;
	}
	
	public static function grade($conn, $user_id, $essay_id) {
		$sql = "select grade from user_vote where user_id = $user_id and essay_id = $essay_id";
		$query = $conn->query($sql);
		$data = $query->fetch(PDO::FETCH_ASSOC);
		
		return $data["grade"];
	}
}
?>