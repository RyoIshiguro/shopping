<?php 
  
  App::uses('AppController','Controller');
  App::uses('CakeTime', 'Utility');
  
  class CartController extends AppController
  {
    
    public $uses = array(
      'Login',
      'Products',
      'Details',
      'Cart',
      'Cartitem'
    );
    
    //DateComponentを指定する
    public $components = array('Date');
    
    
    public function beforeFilter()
    {
      parent::beforeFilter();
      
      //beforeFilterセットした変数を別のアクションで使う方法
      // $this->cartitems = $cartitemdata;
      
      // $this->prodata = $prodata;
      
    }
    
    function index()
    {
      $this->layout = "cart";
      
      // echo "Hello Cart";
      
      //<-日時取得->
      //コンポーネントDateから値を取得
      $now = $this->Date->today();
      //Viewに$nowを渡す
      $this->set('now',$now);
      
      
      if($this->request->is('post'))
      {
        
      }
      
      //ポストされたら起動
      if($this->request->is('post'))
      {
        //deleteが押されたか確認
        // var_dump($this->request->data('delete'));
        
        //delete was pushed 押されたのがdeleteなら
        if($this->request->data('delete'))
        {
          //  var_dump($this->request->data);
          // die();
          //update of trigger, update the new data to Cartitem
          //detail_id ＝ $cart_data['Cartitems']['id'];(joinしたデータ)
          //postでdetail_idを受け取ったらcartitemに値をセットする
          //read(null,$this->request->data('detail_id'));のnullの意味は＊全てのフィールドを意味するread(('id','email'),$user_id);とすると指定可能 もしくはarray(''),$user_id
          $this->Cartitem->read(null,$this->request->data('detail_id'));
          //status is changed active to inactive 
          $this->Cartitem->set(
            array(
              //active to inactive 1 -> 0
              'status'=>'0',
              'cancelled_datetime'=>$now
            )
          );
          //save what data was updated
          $this->Cartitem->save();
          // die();
          
          // $this->Cart->read(null,$this->request->data('cart_id'));
          // $this->Cart->set(
          //   array(
          // 
          //     'status'=>'1',
          //     'cancelled_datetime'=>$now
          //   )
          // );
          // //save what data was updated
          // $this->Cart->save();
          // die();
          
          //cartの金額からデリートした分だけの金額を引く
            //up date price, this is in cart amount.
            $data_cart = $this->Cart->read(null,$this->request->data('cart_id'));
            $product_data = $this->Details->read(null,$this->request->data('product_id'));
            // var_dump($product_data);
            // die();
            
            //金額を計算する
            $this->Cart->set(array(
              //カートの金額＋製品の金額 これをカートに追加する。
              'price'=> (int) $data_cart['Cart']['price'] - (int) $product_data['Details']['price']
            ));
            //保存。
            $this->Cart->save();
            
            return $this->redirect('http://localhost:8888/shopping/cart');
        }
        // dubug for post data
        // var_dump($this->request->data);
        
      }
      
      //購入機能 buy feature
      //----------------------------------------------
      if($this->request->is('post'))
      {
        echo $this->request->data('cart_id');
        
        if($this->request->data('buy'))
        {
          // $weapon_name = $this->Product->find('first', array(
          //   'conditions' => array(
          // 		'user_id' => $this->Auth->User('id'),
          //   )
          // ));
          // 
          // $this->set('weapon_name',$weapon_name);
        
          
          $this->Cartitem->read(null,$this->request->data('detail_id'));
          //status is changed active to inactive 
          $this->Cartitem->set(
            array(
              //active to inactive 1 -> 0
              //0 = inactive
              //1 = in cart
              //2 = buy
              'status'=>'2',
              'quantity'=>$this->request->data('count'),
              'paid_datetime'=>$now
            )
          );
          $this->Cartitem->save();
          
          $this->Cart->read(null,$this->request->data('cart_id'));
          $this->Cart->set(
            array(
              //active to inactive 1 -> 0
              'status'=>'2',
              'paid_datetime'=>$now
            )
          );
          //save what data was updated
          $this->Cart->save();
          // die();
          
          //カート合計金額の計算  購入した金額をカード合計から引く
          $data_cart = $this->Cart->read(null,$this->request->data('cart_id'));
          $product_data = $this->Details->read(null,$this->request->data('product_id'));
          //金額を計算する
          $this->Cart->set(array(
            //カートの金額＋製品の金額 これをカートに追加する。
            'price'=> (int) $data_cart['Cart']['price'] - ((int) $product_data['Details']['price'] * $data_cart['Cartitem']['quantity'])
          ));
          //計算結果を保存
          $this->Cart->save();
          
          //calcuration user_money - product_price
          //----------------------------------------------
          //ポストされた会員の残金
          $newMoney = $this->request->data('user_money');
          //
          $this->Login->id = $this->Auth->User('id');
          //フィールド指定して保存する　Login model のmoney fieldに$newmoneyを保存する
          $this->Login->saveField("money",$newMoney);
          //セッションに書き込み Auth.model.field,にfieldに$newmoneyを保存する(更新)
          $this->Session->write('Auth.User.money', $newMoney);
          //$current_user['money']は$newMoneyと指定する
          $current_user['money'] = $newMoney;
          //----------------------------------------------
          
          return $this->redirect("http://localhost:8888/shopping/buy/");
        }
      }
      
      $my_cart_items = $this->Cart->find('all', array(
      	// - main condition
      	'conditions' => array(
      		'user_id' => $this->Auth->User('id'),
      		'Cart.status' => 0,
          //CartItems.status is not in the Cart model but can use from join table.
          'Cartitems.status' => 1
      	),
      	// - joining condition
      	'joins' => array(
      		// - join shopping cart to get the cart information
      		array (
      			'type' => 'LEFT',
      			'table' => 'shopping_cart_items',
            //alias = nickname
      			'alias' => 'Cartitems',
      			'conditions' => 'Cartitems.cart_id = Cart.id'
      		),
      		// - join products to get the product name
      		array (
      			'type' => 'LEFT',
      			'table' => 'products',
      			'alias' => 'Details',
      			'conditions' => 'Cartitems.product_id = Details.id'
      		)
      	),
        'fields' => array(
          //全てのフィールド　select * from tablename; と同じ意味
      		'Cart.*',
      		'Cartitems.*',
      		'Details.*'
      	),
      ));
      // 
      // echo "<pre>";
      // var_dump($my_cart_items);
      // die();
      
      
      $total_cost = 0;
      if (isset($my_cart_items[0]["Cart"]["id"])) {
        $total_cost_cart = $this->Cartitem->find('all', array(
          // - main condition
          'conditions' => array(
            'Cartitem.cart_id' => $my_cart_items[0]["Cart"]["id"],
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
      
      if($this->request->data['checkbox'])
      {
        echo "hello";
      }
      
      //three tables of data in the $cart_data
      $this->set('cart_data',$my_cart_items);
      // echo "<pre>";
      // var_dump($my_cart_items);
      // die();
      $this->set('total_cost',$total_cost);
      // echo "<pre>";
      // var_dump($total_cost);
      // die();
      
    }
    
  }
   
  
 ?>