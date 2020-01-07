<?php 
  
  App::uses('AppController','Controller');
  
  
  class CartController extends AppController
  {
    
    public $uses = array(
      'users',
      'products',
      'shopping_cart',
      'shopping_cart_item'
    );
    
    function index()
    {
      // echo "Hello Cart";
    }
  }
   
  
 ?>