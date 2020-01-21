<?php 
  
  App::uses('AppController','Controller');
  
  
  class ToppageController extends AppController
  {
    public $uses = array(
      'users',
      'Login',
      'Product',
      'shopping_cart',
      'shopping_cart_item'
    );
          
    
    
    function index()
    {   
      //pegination
      //--------------------------------------------
      //あとで使用するのでからの配列を作る
      $array_conditions = array();
      //全データをゲットして$dataとしておく
      $data = $this->request->query;
      
      // pegination
      //降順でページネーションを作成。
      $this -> paginate = array(
        //URlにパラメータを送信するクエリ型にする「?」+「変数名」+「=」+「変数の値」というのが、クエリパラメータの基本構造
        'paramType' => 'querystring',
        //表示限界を決める10個分のデータを表示
        'limit' => 8,
        //表示順
        'order' => array(
          //降順
          'emp_no desc'
        ),
        'conditions' => array(
          //validation なし
        )
      );
      
      // //paginate これがcomponent pagination これがthis-> Admin ->find('all');をしなくてもデータ取得ができる仕組み
      $data = $this -> paginate('Product');

      //viewで使う変数の作成 $admin = $data
      $this->set('product',$data);
      //--------------------------------------------
      
      
      //free search 
      //--------------------------------------------
      if($this->request->query('search'))
      {
        //getの中身 あいまい検索ではpostは使わない get した内容を受け取るのが$test
        $test =  $this->request->query('search');
        
        //デバグ
        // echo "<pre>";
        // var_dump($test);
        // die();
        
        $this->paginate = array(
                'paramType'=>'querystring',
                'limit'=>8,
                'order' => array(
                'emp_no desc'
              ),
              'conditions' => array(
                array(
                  'or' => array(
                array('Product.name like' => '%'.$test.'%')
              )
            )
          )
        );
        
        // //paginate これがcomponent pagination これがthis-> Employee ->find('all');をしなくてもデータ取得ができる仕組み
        $data = $this->paginate('Product');
        
        //デバグ
        // echo "<pre>";
        // var_dump($data);
        
        //viewで使う変数の作成 $employees = $data
        $this->set('product',$data);
      }  
      
      //--------------------------------------------
      
      
      
      //logout
      //--------------------------------------------
      if($this->request->is('post'))
      {
        // var_dump($this->Auth->logout());
        $this->redirect($this->Auth->logout());
      
      }
      //--------------------------------------------
    }
      
      
      
    }
   
  
 ?>