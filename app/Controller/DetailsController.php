<?php 
  
  App::uses('AppController','Controller');
  
  
  class DetailsController extends AppController
  {
    
    public $uses = array(
      'Login',
      'Product'
    );
    
    function index()
    {
      echo "Hello Detalis";
    }
  }
   
  
 ?>