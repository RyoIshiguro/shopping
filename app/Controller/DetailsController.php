<?php 
  
  App::uses('AppController','Controller');
  
  
  class DetailsController extends AppController
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
    
    //$this->Auth->User();でログインユーザーの情報を取得
     $user_data = $this->Auth->User();
     // var_dump($data);
     
     //beforeFilterセットした変数を別のアクションで使う方法
     $this->user = $user_data;
     
     //user login it's working
     if($this->Auth->User('id'))
     {
       //cart_idから一致するデータを取得する
       //model cart からステータス0(pending)とuser_id(ログインユーザー)を取得
       $data = $this->Cart->find('first',array(
         "conditions" => array(
           'status' => '0',
           'user_id'=>$this->Auth->User('id')
           )
         )
       );
       
       $total_cost = 0;
       if (isset($data["Cart"]["id"])) {
         $total_cost_cart = $this->Cartitem->find('all', array(
           // - main condition
           'conditions' => array(
             'Cartitem.cart_id' => $data["Cart"]["id"],
             'Cartitem.status' => 1
           ),
           'fields' => array(
             "SUM(Cartitem.price * Cartitem.quantity) as total_cart_price"
           )
         ));
         
         if (isset($total_cost_cart[0][0]["total_cart_price"])) {
           $total_cost = $total_cost_cart[0][0]["total_cart_price"];
         }
       }
       
       //ログインデータから
       $this->set('current_cart',$data);
       $this->set('total_cost',$total_cost);
     }
       else 
       {
         //ログインしていないならtopに戻す
         // $this->redirect('http://localhost:8888/shopping/');
       }
     // echo "<pre>\n";
     // var_dump($data);
     
     
  }
  
  //DateComponentを指定する
  public $components = array('Date');
    
    function index()
    {
      //カートレイアウトを使用する
      $this->layout = "cart";
      //<-日時取得->
      //コンポーネントDateから値を取得
      $now = $this->Date->today();
      // var_dump($now);
      // var_dump(date_default_timezone_get());
      // die();
      //Viewに$nowを渡す
      $this->set('now', $now);
      
      //カート生成時点では０なので、０を入れる
      $price = 0;
      //checking from form data
      // $get = $this->request->query;
      // var_dump($post);echo "<br>\n";
      // var_dump($get);echo "<br>\n";
        
        $product_id = $this->request->query('id');
        //デバグ用
        //echo "<pre>";
        // var_dump($product_id);
        //die();  
        
          //取得した商品idと一致するデータをmodel detailから取得
          $data_details = $this->Details->find('first',array(
            "conditions" => array(
              'id' => $product_id,
            )
          ));
          
          $price = $data_details['Details']['price'];
          // var_dump($data);
          // die();
      // http://localhost:8888/shopping/cart/    //viewで使う$employeeを作成
          $this -> set('product', $data_details);
      // }
    
      //  
      if($this->request->is('post'))
      {
        // die();
        
        $product_id = $this->request->query('id');
        
        $data_cart = $this->Cart->find('first',array(
            "conditions" => array(
              'status' => '0',
              'user_id'=>$this->Auth->User('id')
            )
          )
        );
        // echo "<pre>";
        // echo "user_id";echo "<br>\n";
        // var_dump($this->Auth->User('id'));
        // var_dump($this->Auth->User('id'));
        
        //if data is null (false)
        if(!$data_cart)
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
          //保存。
          $data_cart = $this->Cart->save();
        } 
          else
          {
            echo "faild insert cart id";
            var_dump($data_details);
          }
          // var_dump($data);
          // die();
          
            // $this -> set('product', $data);
            
        if($this->request->data('button_cart'))
        {
          // var_dump($this->request->data);
          // die();
          echo "cart";
          //cartにデータ保存＝shopping_cart tableにデータ生成
          $this->Cartitem->create();
          $this->Cartitem->set(array(
            'product_id'=>$product_id,
            'user_id'=>$this->Auth->User('id'),
            'cart_id'=>$data_cart['Cart']['id'],
            'quantity'=>'1',//1=in the cart still pending
            'price'=>(int)$price,
            'added_datetime'=>$now
          ));
          $this->Cartitem->save();
          // var_dump($data_details);
          // var_dump($this->Cartitem->save());
          // die();
          
          
          //up date price, this is in cart amount.
          $data_cart = $this->Cart->read(null,$data_cart['Cart']['id']);
          // var_dump($data_cart);
          // die();
          
          //金額を計算する
          $this->Cart->set(array(
            //カートの金額＋製品の金額 これをカートに追加する。
            'price'=> (int) $data_cart['Cart']['price'] + (int)$data_details['Details']['price']
          ));
          //保存。
          $this->Cart->save();
          
          
          return $this->redirect('http://localhost:8888/shopping/cart/');
        } 
        
      }
      
      
      //buy now in the detail page
      //----------------------------------------------
      if($this->request->is('post'))
      {
        // die();
        if($this->request->data['button_buy'])
        {
          
          // 1. make cart -> paid
          // 2. make cart item from point 1
          // 3. deduct money from user
          // echo "<br>\n";
          // var_dump($price);
          // die();
          
          $this->Cart->create();
          $this->Cart->set(array(
            //0=pending
            //1=cancel
            //2=pharches
            'status'=>'2',
            'user_id'=>$this->Auth->User('id'),
            'price'=>$price,
            'created_datetime'=>$now,
            'paid_datetime'=>$now,
            'cancelled_datetime'=>''
          ));
          $this->Cart->save();
          
          
          $this->Cartitem->create();
          $this->Cartitem->set(array(
            'product_id'=>$product_id,
            'user_id'=>$this->Auth->User('id'),
            'cart_id'=>$data_cart['Cart']['id'],
            'quantity'=>'1',
            'price'=>(int)$price,
            'added_datetime'=>$now,
            'paid_datetime'=>$now
          ));
          $this->Cartitem->save();
          
              
          //calcuration user_money - product_price
          //----------------------------------------------
          //ポストされた会員の残金
          $newMoney = $this->request->data('user_money');
          //デバグ用
          // echo "<pre>";
          // var_dump($this->request->data('user_money'));
          // die();
          $this->Login->id = $this->Auth->User('id');
          //フィールド指定して保存する　Login model のmoney fieldに$newmoneyを保存する
          $this->Login->saveField("money",$newMoney);
          //セッションに書き込み Auth.model.field,にfieldに$newmoneyを保存する(更新)
          $this->Session->write('Auth.User.money', $newMoney);
          //$current_user['money']は$newMoneyと指定する
          $current_user['money'] = $newMoney;
          //----------------------------------------------
              
              // var_dump(6);
              
              return $this->redirect("http://localhost:8888/shopping/buy/");
            }
      } 
        //----------------------------------------------  
        
    }
  }
   
  
?>