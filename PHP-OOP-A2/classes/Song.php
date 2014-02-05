<?php 

class Song{
	
	protected $pdo;
	protected $sql;
	protected $title;
	protected $id;
	
	
	public function __construct($pdo){
		$this->pdo=$pdo;
		$this->sql="INSERT INTO songs (title, artist_id, genre_id, price) VALUES (";
	}
	
	public function setTitle($title){
		$this->title=$title;
		$this->sql .="'".$title."', ";
	}
	public function setArtistId($artistid){
		$this->sql .=$artistid.", ";
	}
	public function setGenreId($genreid){
		$this->sql .=$genreid.", ";
	}
	public function setPrice($price){
		$this->sql .=$price.")";
	}
	public function save(){
		$statement = $this->pdo->prepare($this->sql);
		echo "hi ".$this->sql;
		return $statement->execute();
		
	}
	public function getTitle(){
		return $this->title;
	}
	public function getId(){
		return $this->pdo->lastInsertId();
	}
}

?>