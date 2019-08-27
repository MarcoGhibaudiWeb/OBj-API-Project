<?php


//use Opeldo\Core\Controller;
/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

class HomeController extends BaseController
{
    
    public function __construct()
    {
			$this->loadModel('HomeModel');

	}
    

    public function index()
    {
        
        $pageTitle = 'SuntTo';

            require APP . 'view/_templates/header.php';
            require APP . 'view/home/index.php';
            require APP . 'view/_templates/footer.php';
    }


    public function search()
    {
        $value = $_POST;
        $results = $this->model->searchArtist($value);


        if($results){

            $pageTitle = 'Results';

            require APP . 'view/_templates/header.php';
            require APP . 'view/home/results.php';
            require APP . 'view/_templates/footer.php';

        } else {
            
            $pageTitle = "Unknown";
            header ("location:".URL."error");

        }

    }



    public function artist($name){

        error_reporting(0); 
        ini_set('display_errors', 0);

        
        $addSearch = $this->model->addSearch($name);
	
        $releases = $this->model->getArtistReleases($name);
         
        $bio = $this->model->getArtistBio($name);

        $musicSC = $this->model->soundcloudArtist($name);

        $musicYT = $this->model->youtubeArtist($name);

        $event = $this->model->getEvent($name);


         if($name){

            $pageTitle = $name;

            require APP . 'view/_templates/header.php';
            require APP . 'view/home/artist.php';
            require APP . 'view/_templates/footer.php';

        } else {
            
            $pageTitle = "Unknown";
            header ("location:".URL."error");

        }
        

    }

    
}
