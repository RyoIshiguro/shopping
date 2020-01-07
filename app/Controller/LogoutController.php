<?php 
  
  App::uses('AppController','Controller');
  /**
   * 
   */
  class LogoutController extends AppController
  {
    
    function index()
    {
      // //sample cord from lester for specific session how to delete
      // $this->Session->write("name", "lester");
      // $name = $this->Session->read("name");
      // 
      // // we use this for deleting specific session items using session component
      // $this->Session->delete("name");
      // var_dump($name);
      // 
      // $name = $this->Session->read("name");
      // var_dump($name);
      
      // we use this for deleting auth component sessions
      // $this->Auth->login()
      return $this->redirect($this->Auth->logout());
    }
  }
    

 ?>