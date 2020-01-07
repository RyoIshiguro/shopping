<?php 
  //model post.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  App::uses('AppModel', 'Model');
  App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
  
  /**
   * 
   */
  class Admin extends AppModel
  {
    public $useTable = 'users';
    
    //ハッシュ化されたパスワードと入力したパスワードの比較
    public function beforeSave($options = array())
    {
      if (isset($this->data[$this->alias]['password']))
      {
        //Blowfishはパスワードがハッシュが変わり続ける事件があって使わずmd５を使用した。
        // $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = md5(
            $this->data[$this->alias]['password']
        );
      }
      return true;
    }
  }
  
 ?>