<?php 
namespace ITP\Songs;

class SongQuery{
	
	protected $pdo;
	protected $sql;
	protected $title;
	protected $id;
	
	
	public function __construct($pdo){
		$this->pdo=$pdo;
		$this->sql="SELECT title, artist_name, genre, price FROM songs ";
		return $this;
	}
	
	public function withArtist(){
		$this->sql .="INNER JOIN artists ON artists.id=songs.artist_id ";
		return $this;
	}
	public function withGenre(){
		$this->sql .="INNER JOIN genres  ON genres.id=songs.genre_id ";
		return $this;
	}
	public function orderBy($title){
		$this->sql .="ORDER BY " . $title;
		return $this;
	}
	public function all(){
		$statement = $this->pdo->prepare($this->sql);
		$statement->execute();
		return $statement->fetchAll();
	}
	
}

?>