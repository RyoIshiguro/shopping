<?php 
  
  App::uses('AppController','Controller');
  
  
  class CartController extends AppController
  {
    
    public $uses = array(
      'Login',
      'Products',
      'Cart'
    );
    
    function index()
    {
      echo "Hello Cart";
    }
  }
   
  
 ?>