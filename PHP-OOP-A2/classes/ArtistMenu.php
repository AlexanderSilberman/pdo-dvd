<?php

class ArtistMenu{
	public $string;
	public $artists;
	
	public function __construct($name, $artist){
		$this->artists=$artist;
		$this->string="<select name='". $name."'>";
	}
	public function __toString(){
		foreach($this->artists as &$artist) : 
			$this->string .="<option value='".$artist['id']."'>".$artist['artist_name']."</option>";
        endforeach;
		
		$this->string .="</select>";
		
		return $this->string;
	}
}
?>