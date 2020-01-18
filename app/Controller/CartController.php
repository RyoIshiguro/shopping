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
          //detail_id ＝ $cart_data['Cartitems']['id'];
          //postでdetail_idを受け取ったらcartitemに値をセットする
          //read(null,$this->request->data('detail_id'));のnullの意味は＊全てのフィールドを意味するread(('id','email'),$user_id);とすると指定可能 もしくはarray(''),$user_id
          $this->Cartitem->read(null,$this->request->data('detail_id'));
          //status is changed active to inactive 
          $this->cartitem->set(
            array(
              //active to inactive 1 -> 0
              'status'=>'0'
            )
          );
          //save what data was updated
          $this->cartitem->save();
          // die();
        }
        // dubug for post data
        // var_dump($this->request->data);
        
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