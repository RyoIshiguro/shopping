<?php 
  
  App::uses('AppController','Controller');
  
  
  class DetailsController extends AppController
  {
    
    public $uses = array(
      'Login',
      'Product',
      'Details'
    );
    
    function index()
    {
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
          //viewで使う$employeeを作成
          $this -> set('product', $data);
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