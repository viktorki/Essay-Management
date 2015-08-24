<?php
include("constants.php");

class User {
	private $id;
	private $username;
	private $password;
	private $firstName;
	private $middleName;
	private $lastName;
	private $role;
	private $fn;
	private $essayId;
	
	function __construct($username, $firstName, $middleName, $lastName, $role, $fn, $essayId) {
		$this->username = $username;
		$this->firstName = $firstName;
		$this->middleName = $middleName;
		$this->lastName = $lastName;
		$this->role = $role;
		$this->fn = $fn;
		$this->essayId = $essayId;
	}

	function __get($property) {
		return $this->$property;
	}
	
	public static function getUserById($conn, $id) {
		$sql = "select * from user where id = $id";
		$query = $conn->query($sql);
		$data = $query->fetch(PDO::FETCH_ASSOC);
		
		return new User($data["username"], $data["first_name"], $data["middle_name"], $data["last_name"], $data["role"], $data["fn"], null);
	}
	
	public static function getAllStudents($conn) {
		$sql = "select username, first_name, middle_name, last_name, fn, e.id essay_id from user u left join essay e on u.id = e.user_id where u.role = 1 and (version is null or version = (select max(version) from essay e2 where e2.user_id = e.user_id)) order by fn";
		$query = $conn->query($sql);
		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$userList[] = new User($data["username"], $data["first_name"], $data["middle_name"], $data["last_name"], 1, $data["fn"], $data["essay_id"]);
		}
		
		if (isset($userList))
			return $userList;
		
		return null;
	}
}
?>