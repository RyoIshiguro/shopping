<?php 
  //model post.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  
  /**
   * 
   */
  class Cart extends AppModel
  {
    public $useTable = 'shopping_cart';
  }
  
 ?>