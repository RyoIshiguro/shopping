
<?php 
  //model Toppage.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  
  /**
   * 
   */
  class Toppage extends AppModel
  {
    public $useTable = 'users';
  }
  
 ?>