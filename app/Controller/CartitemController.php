<?php 

  App::uses('AppController','Controller');

  class CartitemController extends AppController
  {
    public $uses = array(
      'Login',
      'Products',
      'Details',
      'Cart',
      'Cartitem'
    );
    
    function index()
    {
      echo "hello shopping_cart_item";
    }
  }
  
 ?>