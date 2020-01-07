<?php 
  //LoginController
  App::uses('AppController','Controller');
  App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
  
  class LoginController extends AppController
  {
    
    public $uses = array(
      //model名を指定する
      'Login',
      'Register'
    );
    
    
    
    public function beforeFilter()
    { 
      // ユーザー自身による登録とログアウトを許可する
      $this->Auth->allow('index','login','logout','register');
    }
    
    
    public function index()
    {
      // echo "Hello Login";
      
      if($this->request->is('post'))
      {
        // $this->set('id',$this->Auth->User('id'));
        $this->set('username',$this->Auth->User('username'));
        //$username と $password に格納する
        //md5でパスワードをハッシュ化する
        // $id = $this->request->data['Login']['id'];
        $username = $this->request->data['Login']['username'];
        $password = md5($this->request->data['Login']['password']);
        // echo "<pre>";
        // var_dump($this->Auth->User('id'));
        // var_dump($this->Auth->User('username'));
        // var_dump($id);
        // var_dump($username);
        // var_dump($password);
        // die();
        
        //Blowfishはパスワードがハッシュが変わり続ける事件があって使わなかった。
        //find('first','')で特定のものを照合可能。 
        //findの後にarray()conditionを追加することで、特定が可能 
        $isValid = $this->Login->find('first', array(
          'conditions' => array(
            // "id" => $id,
            "username" => $username,
            "password" => $password
          )
        ));
        //
        if ($isValid) 
        {
          // var_dump($isValid);
          // die();
          $this->Auth->login($isValid["Login"]);
          // echo "<pre>";
          // // var_dump($isValid);
          // var_dump($isValid["Login"]);
          // die();
          
          if($isValid['Login']['user_type'] == 'admin')
          {
            return $this->redirect('http://localhost:8888/shopping/admin');
          }
           else 
           {
             return $this->redirect('http://localhost:8888/shopping/');
           }
          
        }
          else 
          {
            $this -> Flash -> error(sadas
              __('Your username or password are wrong ',h($id))
            );
          }
        
      }
    
      
    }
    
    public function logout()
    {
      // $this->Session->write('Auth', $this->User->read(null, $this->Auth->User('')));
      
      // $this->request->session()->destroy(); 
      // $this->Session->delete('username');
      // return $this->redirect($this->Auth->logout()); 
      
      // $this->redirect($this->Auth->logout());
      // 
      // if ($this->request->is('post')) 
      // {
      //   $this->set('username',$this->Auth->User('username'));
      //   //$username と $password に格納する
      //   //md5でパスワードをハッシュ化する
      //   // $username = $this->request->data['Login']['id'];
      //   $username = $this->request->data['Login']['username'];
      //   $password = md5($this->request->data['Login']['password']);
      // 
      //   //Blowfishはパスワードがハッシュが変わり続ける事件があって使わなかった。
      //   //find('first','')で特定のものを照合可能。 
      //   //findの後にarray()conditionを追加することで、特定が可能 
      //   $isValid = $this->Login->find('first', array(
      //     'conditions' => array(
      //       // "id" => $id,
      //       "username" => $username,
      //       "password" => $password
      //     )
      //   ));
      //   //
      //   if ($isValid) 
      //   {
          // $this->Auth->logout($isValid["Login"]);
      //     $this->Session->delete('username'.$this->Auth->User('username'));
      //     return $this->redirect();
      //   }
      // 
      // 
      //   // $this->Auth->logout($isValid["Login"]);
      //   // 
      //   // $this->set('username',"");
      // 
      //   // $this->redirect($this->Auth->logout('/shopping/login'));
      //   // return $this->redirect('/toppage/index');
      // }
      //  else 
      //  {
      //    echo "logout faild";
      //  }
    // 
     }
    
  }
   
  
 ?>