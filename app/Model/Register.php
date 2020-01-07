<?php 
  //model post.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  App::uses('AppModel', 'Model');
  App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
  /**
   * 
   */
  class Register extends AppModel
  {
    public $useTable = 'users';
    
    public $validate = array(
      'first_name' => array(
        'required' => array(
          'rule' => 'notBlank',
          'message' => 'A firstname is required'
        )
      ),
      'last_name' => array(
        'required' => array(
          'rule' => 'notBlank',
          'message' => 'A lastname is required'
        )
      ),
      'username' => array(
        'required' => array(
          'rule' => 'notBlank',
          'message' => 'A username is required'
        )
      ),
      'username' => array(
        'required' => array(
          'rule' => 'isUnique',
          'message' => 'This username is used already'
        )
      ),
      'email' => array(
        'required' => array(
          'rule' => 'notBlank',
          'message' => 'A email is required'
        )
      ),
      'email' => array(
          'rule' => 'isUnique',
          'message' => 'This email is used already'
      ),
      'password' => array(
        'required' => array(
          'rule' => 'notBlank',
          'message' => 'A password is required'
        )
      )
    );
    
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