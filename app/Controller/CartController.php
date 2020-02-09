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
      
      $price = 0;
      
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
        // echo $this->request->data('cart_id');
        
        if($this->request->data('buy'))
        {
          // echo "buy is posted";
          // product_id[]
          // product_quantity[]
          // var_dump($product_data['Details']['price']);
          // echo "<pre>";
          // var_dump((array)$this->request->data('user_id'));
          // var_dump($this->request->data('product_id'));
          // var_dump($this->request->data('cart_id'));
          // var_dump($this->request->data('product_price'));
          // var_dump($this->request->data('product_quantity'));
          // var_dump($this->request->data('cart_amount_total'));
          // var_dump(($this->request->data('product_price') * $this->request->data('product_quantity')));
          // die();
          $total_price = 0;
          //end($this->request->data('cart_amount_total'))で配列のまま渡すとエラーになるので変数に格納してから渡す。
          $cart_amount_tatal = $this->request->data('cart_amount_total');
          
          foreach ($this->request->data('product_price') as $price)
          {
            $total_price = $total_price + $price;
          }
          // var_dump($total_price);
          // die();
          
          // $total_quantity = 0;
          // 
          // foreach ($this->request->data('product_quantity') as $quantity) 
          // {
          //   $total_quantity = $total_quantity + $quantity;
          // }
          // var_dump($total_quantity);
          // die();
          
          
          for ($i=0; $i < count($this->request->data('cart_id')); $i++)
          {
            $this->Cartitem->read(null,$this->request->data('cart_id')[$i]);
            //status is changed active to inactive 
            $this->Cartitem->set(
              array(
                // 'product_id'=>$this->request->data('product_id')[$i],
                //active to inactive 1 -> 0
                //0 = inactive
                //1 = in cart
                //2 = buy
                'status'=>'2',
                'quantity'=>(int)$this->request->data('product_quantity')[$i],
                'price'=>(int)$this->request->data("product_price")[$i] * (int)$this->request->data('product_quantity')[$i],
                'paid_datetime'=>$now
              )
            );
            $new_Cartitem_data = $this->Cartitem->save();
          }
          
          
          // for ($i=0; $i < count($this->request->data('cart_id')); $i++) 
          // {
            $this->Cart->read(null,$this->request->data('parent_cart_id'));
            $this->Cart->set(
              array(
                //active to inactive 1 -> 0
                'user_id'=>$this->Auth->User('id'),
                'status'=>'2',
                'price'=>(int)end($cart_amount_tatal),
                'paid_datetime'=>$now
              )
            );
            
            //デバグ用
            // var_dump($this->request->data("cart_amount_total"));
            // die();
            
            //save what data was updated
            $new_Cart_data = $this->Cart->save();
            //デバグ用
            // var_dump($new_Cart_data['Cart']['price']);
            // die();
          
          //----------------------------------------------
          //ポストされた会員の残金
          $newMoney = $this->request->data('user_money');
          //デバグ用
          // var_dump((int)$newMoney);
          // die();
          //
          $this->Login->id = $this->Auth->User('id');
          // var_dump($this->Login->id);
          // die();
          //フィールド指定して保存する　Login model のmoney fieldに$newmoneyを保存する
          $this->Login->read(null,$this->Auth->User('id'));
          $this->Login->set(
            array(
              'money'=>$newMoney - $new_Cart_data['Cart']['price']
            )
          );
          
          $newLogin_data = $this->Login->save();
          // var_dump($newLogin_data['Login']['money']);
          // die();
          
          
          // $this->Login->saveField("money",$newLogin_data['Login']['money']);
          //セッションに書き込み Auth.model.field,にfieldに$newmoneyを保存する(更新)
          
          $this->Session->write('Auth.User.money',$newLogin_data['Login']['money']);
          //$current_user['money']は$newMoneyと指定する
          $current_user['money'] = $newLogin_data['Login']['money'];
          //----------------------------------------------
          
          return $this->redirect("http://localhost:8888/shopping/buy/");
        }
      }
      
      //table join cart*details*CartItems
      //$my_cart_itemsの中身はjoin
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
      
      //$total_costはcartの金額
      $total_cost = 0;
      
      //Cart tableのid　index 0がセットされたらcartitem modelで↓の条件を出す
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