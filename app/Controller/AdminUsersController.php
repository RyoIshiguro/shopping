<?php 
  //App::uses('クラス名','パッケージ名');AppController.phpの中にある
  App::uses('AppController','Controller');


  class AdminController extends AppController
  {
    
    public $uses = array(
      'users',
      'products',
      'shopping_cart',
      'shopping_cart_item'
    );
    
    function index()
    {
      echo "Hello Admin";
    }
  }
 ?>