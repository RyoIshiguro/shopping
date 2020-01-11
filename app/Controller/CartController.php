<?php 
  
  App::uses('AppController','Controller');
  App::uses('CakeTime', 'Utility');
  
  class CartController extends AppController
  {
    
    public $uses = array(
      'Login',
      'Products',
      'Details',
      'Cart'
    );
    
    //DateComponentを指定する
    public $components = array('Date');
    
    
    public function beforeFilter()
    {
      parent::beforeFilter();
      
      //$this->Auth->User();でログインユーザーの情報を取得
       $user_data = $this->Auth->User();
       // var_dump($data);
       
       //beforeFilterセットした変数を別のアクションで使う方法
       $this->user = $user_data;
       
       //user login it's working
       if($this->Auth->User('id'))
       {
         //cart_idから一致するデータを取得する
         //model cart からステータス0とuser_id(ログインユーザー)を取得
         $data = $this->Cart->find('first',array(
           "conditions" => array(
             'status' => '0',
             'user_id'=>$this->Auth->User('id')
             )
           )
         );
         //ログインデータから
         $this->set('current_cart',$data);
       }
         else 
         {
           //ログインしていないならtopに戻す
           // $this->redirect('http://localhost:8888/shopping/');
         }
       var_dump($data);
       
       
    }
    
    function index()
    {
      // echo "Hello Cart";
      
      //<-日時取得->
      //コンポーネントDateから値を取得
      $now = $this->Date->today();
      //Viewに$nowを渡す
      $this->set('now', $now);
      
      if($this->request->is('get'))
      {
        //beforeFilterセットした変数を別のアクションで使う方法
        //beforeFilter呼び出し時にセットした変数を呼び出すことが可能
        // echo "<pre>";
        // var_dump($this->user);
        // 変数に再度入れたい場合はこのようにしてください
        // echo "<pre>";
        // $data = $this->user;
        // var_dump($data);
        // echo "<br>\n";
        
        //こんな感じで配列の指定が可能になる
        // echo $data['id'];
      }
      
      
    }
  }
   
  
 ?>