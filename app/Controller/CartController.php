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
      'cartitem'
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
      
      
      //ポストされたら起動
      if($this->request->is('post'))
      {
        //deleteが押されたか確認
        // var_dump($this->request->data('delete'));
        
        //delete was pushed 押されたのdがdeleteなら
        if($this->request->data('delete'))
        {
          //update of trigger, update the new data to Cartitem
          //detail_id ＝ $cart_data['Cartitems']['id'];(joinしたデータ)
          //postでdetail_idを受け取ったらcartitemに値をセットする
          //read(null,$this->request->data('detail_id'));のnullの意味は＊全てのフィールドを意味するread(('id','email'),$user_id);とすると指定可能 もしくはarray(''),$user_id
          $this->Cartitem->read(null,$this->request->data('detail_id'));
          //status is changed active to inactive 
          $this->cartitem->set(
            array(
              //active to inactive 1 -> 0
              'status'=>'0',
              'cancelled_datetime'=>$now,
            )
          );
          //save what data was updated
          $this->cartitem->save();
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
      if($this->request->is('post'))
      {
        // echo "buy";
        if($this->request->data('buy'))
        {
          $this->Cartitem->read(null,$this->request->data('detail_id'));
          //status is changed active to inactive 
          $this->cartitem->set(
            array(
              //active to inactive 1 -> 0
              'status'=>'2',
              'paid_datetime'=>$now
            )
          );
          $this->cartitem->save();
          
          $this->Cart->read(null,$this->request->data('cart_id'));
          $this->Cart->set(
            array(
              //active to inactive 1 -> 0
              'Cart.status'=>1
            )
          );
          //save what data was updated
          $this->Cart->save();
          // die();
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
      
      // echo "<pre>";
      // var_dump($my_cart_items);
      // die();
      
      //three tables of data in the $cart_data
      $this->set('cart_data',$my_cart_items);
      
      
    }
    
  }
   
  
 ?>