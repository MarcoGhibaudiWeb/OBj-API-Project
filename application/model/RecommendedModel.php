<?php

class RecommendedModel extends BaseModel
{

	public function displayRec(){

		$stmt = $this->db->prepare("SELECT * FROM search");
	$stmt->execute();
	$recents= $stmt->fetchAll();

	 $artists = NULL;

	foreach ($recents as $artist):
	
		if($artist->qt<= 10 && $artist->qt>1){



		$response =file_get_contents("http://ws.audioscrobbler.com/2.0?method=artist.getsimilar&artist=".urlencode($artist->title)."&limit=1&api_key=aa0766805f99ada73d458bade55d97b8&format=json");
		
		$response = json_decode($response);

		$artist =$response->similarartists->artist;

		$artists = (object) array_merge((array) $artists, (array) $artist);
		
	}else if ($artist->qt>10){


		$response =file_get_contents("http://ws.audioscrobbler.com/2.0?method=artist.getsimilar&artist=".urlencode($artist->title)."&limit=3&api_key=aa0766805f99ada73d458bade55d97b8&format=json");
		
		$response = json_decode($response);

		$artist =$response->similarartists->artist;

		$artists = (object) array_merge((array) $artists, (array) $artist);
	}


	endforeach;

	return$artists;







}




	
}










;




