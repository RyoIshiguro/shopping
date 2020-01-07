<?php 
  
  App::uses('AppController','Controller');
  
  class LoopholeController extends AppController
  {
    
    public $uses = array(
      //model名を指定
      'Loophole'
    );
    
    
    function index()
    {
      // echo "Hello Loophole";echo "<br>\n";
      if($this->request->is('post'))
      {
        
        
        if($userTable = 'users')
        {
          //デバグ用
          // echo "correct";
          // echo "<pre>";
          // var_dump($this->Loophole->find('all')); 
          // debug($this->request->data);
          // die();
        }
        
    
        $this->Loophole->create();
        $data = $this->request->data;
        // $this->Loophple->set($data);
        var_dump($data);
        //if($this->Loophole->save($data,false)として第二引数にfalseを渡すとvalidationを無視することが可能
        if($this->Loophole->save($data))
        {
          $this->Flash->success(__('The Admin has been saved.'));
          // return $this->redirect(array('action' => 'index'));
          return $this->redirect('http://localhost:8888/shopping/Toppage/index');
        }else{
          $this->Flash->error(__('The Admin could not be saved. Please, try again.'));
        }
      }
      
      
    }
      
  }
   
  
 ?>