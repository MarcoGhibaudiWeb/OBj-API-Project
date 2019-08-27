<?php


class HomeModel extends BaseModel
{

	public function getArtistReleases($name) {	

		$link = "https://www.discogs.com/artist/".rawurlencode($name);
		$link = get_headers($link);
		$link = $link[6];
		$id =  preg_replace('/[^0-9]/', '', $link);


		
		$curl = curl_init();

		curl_setopt_array($curl, array(
  			CURLOPT_URL => "https://api.discogs.com/artists/".$id."/releases?",
  			CURLOPT_RETURNTRANSFER => true,
  			CURLOPT_ENCODING => "",
  			CURLOPT_MAXREDIRS => 10,
  			CURLOPT_TIMEOUT => 30,
  			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  			CURLOPT_CUSTOMREQUEST => "GET",
  			CURLOPT_USERAGENT => "MP_Marco"
		));

		
		$response = curl_exec($curl);
		curl_close($curl);

		$releases = json_decode($response);

		return $releases;

		

	}

	public function getArtistBio($name){

	$name = urlencode($name);		


	$response =file_get_contents("http://ws.audioscrobbler.com/2.0?method=artist.getinfo&artist=".$name."&limit=1&api_key=aa0766805f99ada73d458bade55d97b8&format=json");
	$bio = json_decode($response);

	return $bio; 

	}


	
	public function soundcloudArtist($name){
	
		$name = rawurlencode($name);

		$key ="AIzaSyBK73boRL_N7UhFJr1LrBeaIfJULS8f_MM";
		//$key ="AIzaSyD9K-M_eNgjW2FzZ1GVeX_jETmqUVTUTKQ";
		//$key ="AIzaSyCqthrOfIU9F6cmlnJpAlPro37npAsP6DM";
		

		$response =file_get_contents("https://www.googleapis.com/customsearch/v1?q=".$name.".&cx=008630739161779150909%3Abod_gxphnnw&num=1&key=$key");
		
		$search = json_decode($response);



		$link = substr_replace($search->items[0]->link, "%3A", 5, 1);

		$response =file_get_contents("https://api.soundcloud.com/resolve?url=".$link."&client_id=OgPiZDOMYXnoiMl3ugzdAB5jGBGtroyf");
  
		$artist = json_decode($response);

		$response =file_get_contents("http://api.soundcloud.com/users/".$artist->id."/tracks?client_id=OgPiZDOMYXnoiMl3ugzdAB5jGBGtroyf&limit=5");
  
		$musicSC = json_decode($response);

		return $musicSC;

}

public function youtubeArtist($name){


	$name = rawurlencode($name)."+music";

	$key ="AIzaSyBK73boRL_N7UhFJr1LrBeaIfJULS8f_MM";
	//$key ="AIzaSyD9K-M_eNgjW2FzZ1GVeX_jETmqUVTUTKQ";
	//$key ="AIzaSyCqthrOfIU9F6cmlnJpAlPro37npAsP6DM";

	$response =file_get_contents("https://www.googleapis.com/customsearch/v1?q=".$name."&cx=008630739161779150909%3Ax6xsx_8xgs8&key=$key");
		
	$musicYT = json_decode($response);
	
	return $musicYT;


}

public function getEvent($name){


	$name = rawurlencode($name);

	$response =file_get_contents("https://www.skiddle.com/api/v1/events/search?keyword=".$name."&api_key=31bf3517d668117433b461ae43a8ce61");
  
	$event = json_decode($response);

	return $event;

}

	public function searchArtist($value){

		$query = $value ['search'];

		$query = rawurlencode($query);
		
		$response =file_get_contents("http://ws.audioscrobbler.com/2.0?method=artist.search&artist=".$query."&limit=9&api_key=aa0766805f99ada73d458bade55d97b8&format=json");
		
		   $search = json_decode($response);


		return $search;


	}

	

public function addSearch($name){


	$stmt = $this->db->prepare("SELECT * FROM search WHERE title=:n");
	$stmt->execute(array('n'=>$name));

	if ($stmt->rowCount()){

		$stmt =$this->db->prepare("UPDATE search set qt= qt+1 WHERE title=:n");
		$stmt->execute(array('n'=>$name));		
	} else{

		$stmt = $this->db->prepare("SELECT * FROM search");
		$stmt->execute();

		if($stmt->rowCount() >= 15){

			$stmt = $this->db->prepare("DELETE FROM search order by recent limit 1 ");
			$stmt->execute();


			$stmt =$this->db->prepare("INSERT INTO search (title, qt) VALUE (:n, 1)");
			$stmt->execute(array('n'=>$name));

		} else {

			$stmt =$this->db->prepare("INSERT INTO search (title, qt) VALUE (:n, 1)");
			$stmt->execute(array('n'=>$name));
		
		} }

		return true;




}
}