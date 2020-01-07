<?php 
  //model post.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  
  /**
   * 
   */
  class Details extends AppModel
  {
    public $useTable = 'products';
  }
  
 ?>