<?php 
  
  App::uses('AppController','Controller');
  
  
  
  class RegisterController extends AppController
  {
    
    public $uses = array(
      //model名を指定
      'Register',
      'Loophole',
      'Login',
      'shopping_cart',
      'shopping_cart_item'
    );
    
    function index()
    {
      // echo "Hello Register";
      if($this->request->is('post'))
      {
        // echo "Hello Register";
        //data['modelname']['value'];でリクエストを取得する
        // $firstname = $this->request->data['Register']['first_name'];
        // $this->set('firstname',$firstname);
        
        // var_dump($firstname);
        // die();
    
          $this->Register->create();
          if($this->Register->save($this->request->data))
          {
            $this->Flash->success(__('The user has been saved.'));
            // return $this->redirect(array('action' => 'index'));
            return $this->redirect('http://localhost:8888/shopping/Toppage/index');
          }else{
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
          }
        }
      }
      
      
    
      
  }
   
  
 ?>