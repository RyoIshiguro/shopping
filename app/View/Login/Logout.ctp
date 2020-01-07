<?php 
  //model Login.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  
  App::uses('AppModel', 'Model');
  App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
  
  /**
   * 
   */
  class Logout extends AppModel
  {
    public $useTable = 'users';
    
    
  }
    
  
  
 ?>