
<div id="main">

<?php

 echo "<div style='padding-left : 10%;width: 80%;'><h1>$name</h1><br><br>";

echo "<img src=".$bio->artist->image[3]->{'#text'}.">";

 echo "<h3> BIOGRAPHY </h3><p>".$bio->artist->bio->summary."</p>";

 echo "<h3> DISCOGRAPHY </h3>";

 if($releases){
    $i = 1;
    $maxreleases = 10;

    foreach($releases->releases as $release):

        if ($i <= $maxreleases) {

            $id =  preg_replace('/[^0-9]/', '', $release->resource_url);

            $url= "https://www.discogs.com/".$release->type."/".$id;

            echo "<a href='".$url."'>".$release->title."</a><br>";

            $i++;
        }

    endforeach;
 }else{echo "<h3> No Releases Available</h5>";}

echo "<h3> SOUNDCLOUD </h3><p>Latest Uploads</p>";

if($musicSC){

    foreach ($musicSC as $result) :

        echo "<h2".$result->title."</h2>";

        echo "<iframe width='100%' height='166' scrolling='no' frameborder='no'
         src='https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/".$result->id."'>
         </iframe>";

    endforeach; 
}else{echo "<h5> No Music Available | If this content doesn't load, try use another key from the HomeModel.php</h5>";}

echo "<h3> YOUTUBE </h3><p>Latest Uploads</p>";

if($musicYT){

    $x = 1;

    foreach($musicYT->items as $result):

        if ($x <= 6) {

            $link = substr_replace($result->link, "", 0, 32);

            echo "<iframe width='480' height='315' style='margin-right:50px;margin-bottom:50px' src='https://www.youtube.com/embed/".$link."' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>"; 

            $x++;
        }
    endforeach;
}else{echo "<h5> No Videos Available | If this content doesn't load, try use another key from the HomeModel.php</h5>";}

echo "<h3> EVENTS </h3><p>Latest</p>";

if($event){
    foreach($event->results as $event):

echo "<div style='width:40%; margin-left:50px;margin-bottom:50px;float:left; text-align:center'><img src=".$event->largeimageurl."><br>"; 
echo "<h3>".$event->eventname." </h3><br> ";
echo $event->venue->town." | ";
echo $event->venue->country." <br> ";
echo $event->description."<br></div>";
endforeach;}else{echo "<h5> No Events Available</h5>";}

echo "</div>";

?>
	 

</div>

