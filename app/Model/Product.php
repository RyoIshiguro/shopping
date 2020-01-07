<?php 
  //model post.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  App::uses('AppModel', 'Model');
  
  /**
   * 
   */
  class Product extends AppModel
  {
    public $useTable = 'products';
  }
  
 ?>