<?php

class RecommendedController extends BaseController
{
 
    public function __construct()
    {
			$this->loadModel('RecommendedModel');

    }
    
  public function index(){

    $artists = $this->model->displayRec();

    if($artists){

      $pageTitle = "Recommended";

      require APP . 'view/_templates/header.php';
      require APP . 'view/recommended/index.php';
      require APP . 'view/_templates/footer.php';

  } else {
      
      $pageTitle = "Unknown";
      header ("location:".URL."error");

  }
  }
}