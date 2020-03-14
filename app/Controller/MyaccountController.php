<?php 

  App::uses('AppController','Controller');
  App::uses('CakeTime', 'Utility');

  /**
   * 
   */
  class MyaccountController extends AppController
  {
    
    public $uses = array(
      'Login',
      'Product',
      'Details',
      'Cart',
      'Cartitem'
    );
    
    public function beforeFilter()
    {
      parent::beforeFilter();
    }
    
    function index()
    {
      if($this->request->is('post'))
      {
        if($this->request->data('edit_user_data'))
        {
          return $this->redirect('http://localhost:8888/shopping/myaccount/user_information_edit');
        }
      }
    }
    
    
    function user_information_edit()
    {
      if($this->request->is('post'))
      {
          // echo "hello";
          // $this->Auth->User('id');
          // //デバグ用
          // echo "<pre>";
          // var_dump($this->request->data('id'));
          // var_dump($this->Auth->User('id'));
          // die();
          
          //for update
          $this ->Login->read(null,$this->Auth->User('id'));

          $this->Login->set(array(
              'username' => $this->request->data('username'),
              'email' => $this->request->data('email')
            )
          );
          
          //ここでtableに保存する
          $this->Login->save();
          
          
          //DBアップデート後に変数のアップデートをする
          //アップデートをしないとDBだけ値が変わって変数は変更前の物が表示されるため。
          
          ////セッションに書き込み Auth.model.field,にfieldに$this->request->data('')を保存する(更新)
          $this->Session->write('Auth.User.username', $this->request->data('username'));
          
          $this->Session->write('Auth.User.email', $this->request->data('email'));
          
          //$current_user['']はpostされたデータに書き換える
          $current_user['username'] = $this->request->data('username');
          
          $current_user['email'] = $this->request->data('email');

          //リダイレクトさせる
          $this->redirect('http://localhost:8888/shopping/myaccount');
        
      }
    }
    
  }
  
 ?>