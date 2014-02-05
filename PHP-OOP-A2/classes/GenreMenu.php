<?php

class GenreMenu{
	public $string;
	public $genres;
	
	public function __construct($name, $genre){
		$this->genres=$genre;
		$this->string="<select name='". $name."'>";
	}
	public function __toString(){
		foreach($this->genres as &$genre) : 
			$this->string .="<option value='".$genre['id']."'>".$genre['genre']."</option>";
        endforeach;
		
		$this->string .="</select>";
		return $this->string;
	}
}
?>