<?php
class Subject {
	private $id;
	private $title;
	
	function __construct($id, $title) {
		$this->id = $id;
		$this->title = $title;
	}
	
	function __get($property) {
		return $this->$property;
	}
	
	public static function getAllSubjects($conn) {
		$sql = "select * from subject";
		$query = $conn->query($sql);
		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$subjectList[] = new Subject($data["id"], $data["title"]);
		}
		
		if (isset($subjectList)) {
			return $subjectList;
		}
		
		return null;
	}
}
?>