<?php



class BaseController
{
    

    # Protected property for child to assign the model.
    protected $model = null; 

    # Protected method for child to load the model
    protected function loadModel($model_name)
    {
        if (file_exists(APP . 'model/' . $model_name . '.php')) {
       
            require_once APP . 'model/' . $model_name . '.php';
            $this->model = new $model_name();
           
        }
            

    }

    protected function startSession($user){

        session_start();

        $_SESSION['user_id'] = $user['uID'];

        if (empty($_SESSION)){
            return FALSE;
        } else {
            return TRUE;
        }

    }

    protected function terminateSession(){
                    
        session_destroy();

        unset($_SESSION);

        if (empty($_SESSION)){
            return TRUE;
        } else {
            return FALSE;
        }
        
    }

    protected function sendAlert($alert){

        session_start();

        $_SESSION['alert'] =  $alert;
    }

    public function deleteAlert(){

        session_start();

        $_SESSION['alert'] =  '';

        unset( $_SESSION['alert']);

        header ("Location:".URL."home");
    }

  
}
