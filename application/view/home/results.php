
<div id="main_left">



<?php

if($results){

foreach($results->results->artistmatches->artist as $artist) : 

	$name = urlencode($artist->name);


	echo "<div class ='img-div-thumbs'><a href=". URL. "home/artist/$name>";

	if($artist->image){
	
		echo "<img src=".$artist->image[3]->{'#text'}."><br>";
	 
	}else{
		
		echo "<img src='' style='width:100px'><br>";
	}
	

	echo($artist->name)."<br></a></div>";


endforeach; 
}else{echo"Something went wrong, try again";}



?>

</div>
