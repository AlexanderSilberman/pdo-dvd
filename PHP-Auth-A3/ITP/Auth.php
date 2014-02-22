<?php
namespace ITP\Authenticate;

class Auth{
	protected $pdo;
	protected $sql;
	protected $email;
	
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
		$this->sql = "SELECT * FROM users WHERE username= :username AND password= :password";
	}
	public function attempt($username,$password)
	{
		$statement = $this->pdo->prepare($this->sql);
		$statement->bindParam(':username', $username);
		$statement->bindParam(':password', $password);
		$statement->execute();
		if($statement->rowCount()>0){
			$all=$statement->fetch();
			$this->email=$all['email'];
			return true;
		}
		return false;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
}

?>