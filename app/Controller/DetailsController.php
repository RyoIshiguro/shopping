<?php 
  
  App::uses('AppController','Controller');
  
  
  class DetailsController extends AppController
  {
    
    public $uses = array(
      'Login',
      'Product',
      'Details',
      'Cart'
    );
    
    //DateComponentを指定する
    public $components = array('Date');
    
    function index()
    {
      //<-日時取得->
      //コンポーネントDateから値を取得
      $now = $this->Date->today();
      //Viewに$nowを渡す
      $this->set('now', $now);
      
      //checking from form data
      // $get = $this->request->query;
      // var_dump($post);echo "<br>\n";
      // var_dump($get);echo "<br>\n";
      
      if($this->request->is('get'))
      {
        // echo "this is get"; echo "<br>\n";
        
        $product_id = $this->request->query('id');
        // var_dump($product_id);
          
          $data = $this->Details->find('first',array(
            "conditions" => array(
              'id' => $product_id
            )
          ));
          // var_dump($employee);
      // http://localhost:8888/shopping/cart/    //viewで使う$employeeを作成
          $this -> set('product', $data);
      }
      
    if($this->request->is('post'))
    {
        $product_id = $this->request->query('id');
        
        $data = $this->Cart->find('first',array(
          "conditions" => array(
            'status' => '0',
            'user_id'=>$this->Auth->User('id')
          )
        )
      );
      var_dump($this->Auth->User('id'));
      
      //if data is null (false)
      if(!$data)
      {
        //model cart にデータ生成
        $this->Cart->create();
        //model cart 生成する値はstatus user_id price
        //生成時はstatusは0で、user_idはlogin_id、priceは0
        $this->Cart->set(array(
          'status'=>'0',
          'user_id'=>$this->Auth->User('id'),
          'price'=>'0',
          'created_datetime'=>$now,
          'paid_datetime'=>'',
          'cancelled_datetime'=>''
        ));
        //保存。そして変数名は$data
        $data = $this->Cart->save();
      }
        // var_dump($data);
        // die();
        
          // $this -> set('product', $data);
          
      
      if(isset($_POST['cart']))
      {
        echo "cart";
        var_dump($data);
        
        //cartにデータ保存
        $this->Cartitem->create();
        $this->Cart->set(array(
          'product_id'=>'',
          'cart_id'=>'',
          'quantity'=>'',
          'price'=>''
        ));
        $this->Cartitem->save();
        
        //cartitemにデータ生成
        $this->Cartitem->create();
        $this->Cart->set(array(
          'product_id'=>'',
          'cart_id'=>'',
          'quantity'=>'',
          'price'=>''
        ));
        $this->Cartitem->save();
        // echo "cart";echo "<br>\n";
        // echo "<br>\n";
        return $this->redirect('http://localhost:8888/shopping/cart/');
      } 
        elseif (isset($_POST['buy'])) 
        {
          echo "buy";
          return $thisr->redirect('http://localhost:8888/shopping/buy/');
        } 
          else 
          {
            echo "error";
            return $this->redirect('http://localhost:8888/shopping/');
          }
    }
      // //あとで使用するのでからの配列を作る
      // $array_conditions = array();
      // //全データをゲットして$dataとしておく
      // $data = $this->request->query;
      // // //paginate これがcomponent pagination これがthis-> Admin ->find('all');をしなくてもデータ取得ができる仕組み
      // $data = $this -> paginate('Product');
      // 
      // $this->set('product',$data);
      // echo "<pre>";
      // var_dump($data['Product']['id']);
      // var_dump($product['Product']['id']);
      // 
      // // var_dump($data['Product']['id']);
      // 
      // // $this->redirect('')
      // 
      // // pegination
      //   //降順でページネーションを作成。
      //   $this -> paginate = array(
      //     //URlにパラメータを送信するクエリ型にする「?」+「変数名」+「=」+「変数の値」というのが、クエリパラメータの基本構造
      //     'paramType' => 'querystring',
      //     //表示限界を決める10個分のデータを表示
      //     'limit' => 10,
      //     //表示順
      //     'order' => array(
      //       //降順
      //       'emp_no desc'
      //     ),
      //     'conditions' => array(
      //       //validation なし
      //     )
      //   );
        
        
    }
  }
   
  
 ?>