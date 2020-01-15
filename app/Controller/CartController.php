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
    
    }
    
    function index()
    {
      // echo "Hello Cart";
      
      //<-日時取得->
      //コンポーネントDateから値を取得
      $now = $this->Date->today();
      //Viewに$nowを渡す
      $this->set('now',$now);
      
      
      $my_cart_items = $this->Cart->find('all', array(
      	// - main condition
      	'conditions' => array(
      		'user_id' => $this->Auth->User('id'),
      		'status' => 0
      	),
      	// - joining condition
      	'joins' => array(
      		// - join shopping cart to get the cart information
      		array (
      			'type' => 'LEFT',
      			'table' => 'shopping_cart_items',
      			'alias' => 'CartItems',
      			'conditions' => 'CartItems.cart_id = Cart.id'
      		),
      		// - join products to get the product name
      		array (
      			'type' => 'LEFT',
      			'table' => 'products',
      			'alias' => 'Details',
      			'conditions' => 'CartItems.product_id = Details.id'
      		)
      	),
        'fields' => array(
      		'Cart.*',
      		'CartItems.*',
      		'Details.*'
      	),
      ));
      
      // echo "<pre>";
      // var_dump($my_cart_items);
      // die();
            
      $this->set('cart_data',$my_cart_items);
      
    }
  }
   
  
 ?>