
<?php 

if($artists){

	echo"<h1 style='text-align:center'> Recommended Artists</h1><br>";

foreach($artists as $artist) : 

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
<!-- 
foreach($artist as $artist) : 

$name = urlencode($artist->name);

echo "<a href=". URL. "home/artist/$name>";

echo($artist->name);
if($artist->image){
echo ("<img src=".$artist->image[3]->{'#text'}."><br>");
}else{echo ("<img src='' style='width:100px'><br>");}

echo "</a>";


endforeach;  -->