<?php 
  //model Login.php
  //DBとやりとりをする。PostsControllerと自動的に接続される。
  //またposts　tableと接続される
  
  App::uses('AppModel', 'Model');
  App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
  
  /**
   * 
   */
  class Myaccount extends AppModel
  {
    public $useTable = 'users';
    
    public $validate = array(
      'username' => array(
        'required' => array(
          'rule' => 'notBlank',
          'message' => 'username is required',
        )
      ),
      'email' => array(
        'required' => array(
          'rule' => 'notBlank',
          'message' => 'email is requrid'
        )  
      )
    );
    
    // public function beforeSave($options = array()) {
    // $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    //     // $this->data['User']['password'] = sha1($this->data['User']['password']);
    // return true;
    // 
    // }
    
    //ハッシュ化されたパスワードと入力したパスワードの比較
    public function beforeFind($options = array())
    {
      if (isset($this->data[$this->alias]['password']))
      {
        $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
      }
      return true;
    }
    
  }
    
  
  
 ?>