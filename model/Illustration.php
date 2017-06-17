<?php

class Illustration{
	
	/*array de path vers images et videos*/
	private $images;
	private $videos;
	
	public function __construct()
	
	/* getters */
	
	public function getImages(){
		return $this->images;
	}
	
	public function getVideos(){
		return $this->videos;
	}
	
}

?>
