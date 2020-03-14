<?php 
  /**
   * 
   */
  class PharcheshistoryController extends AppController
  {
    public $uses = array(
      'Login',
      'Products',
      'Details',
      'Cart',
      'Cartitem'
    );
    
    public function beforeFilter()
    {
      parent::beforeFilter();
    }
    
    function index()
    {
    
      
      $my_cart_items = array();
      if($this->Auth->User('id'))
      {
        $my_cart_items = $this->Cart->find('all', array(
        	// - main condition
        	'conditions' => array(
        		'Cart.user_id' => $this->Auth->User('id'),
        		'Cart.status' => '2',
            //CartItems.status is not in the Cart model but can use from join table.
            'Cartitems.status' => '2'
        	),
        	// - joining condition
        	'joins' => array(
        		// - join shopping cart to get the cart information
        		array (
        			'type' => 'INNER',
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
        $this->set('data_shopping_cart',$my_cart_items);
        
        if($this->Auth->User('id'))
        {
          // $Cart = $this->Cart->find('all');
          // $this->set('Cart',$Cart);
          
          // $Cartitem = $this->Cartitem->find('all');
          // $this->set('Cartitem',$Cartitem);
          
        }
        // echo "<pre>";
        // var_dump($my_cart_items);
        // die();
        
        // $data_shopping_cart = $this->Cartitem->read(null,$this->request->data('user_id'));
        
        // $data_shopping_cart = $this->Cart->find('all',array(
        //   'condition' => array(
        //     'status' => '2',
        //     )
        //   )
        // );
        // 
        // //view で使う変数data_shopping_cart
        // $this->set('data_shopping_cart',$data_shopping_cart);
        
        
        
        // $data_shopping_cart_items = $this->Cart->read(null,$this->request->data('cart_id'));
        // 
        // //view で使う変数data_shopping_cartdata_shopping_cart_items
        // $this->set('data_shopping_cart_items',$data_shopping_cart_items);
        
        
      }
      else 
      {
        return $this->redirect('http://localhost:8888/shopping/login');
      }
      
      
      // pegination
      //--------------------------------------------
      //降順でページネーションを作成。
      $this -> paginate = array(
        //URlにパラメータを送信するクエリ型にする「?」+「変数名」+「=」+「変数の値」というのが、クエリパラメータの基本構造
        'conditions' => array(
          'Cart.user_id' => $this->Auth->User('id'),
          'Cart.status' => '2',
        ),
        'fields' => array(
          //全てのフィールド　select * from tablename; と同じ意味
          'Cart.*'
        ),
        'paramType' => 'querystring',
        //表示限界を決める10個分のデータを表示
        'limit' => 3,
        //表示順
        'order' => array(
          //降順
          'Cart.id desc'
        )
      );
      
      // //paginate これがcomponent pagination これがthis-> Admin ->find('all');をしなくてもデータ取得ができる仕組み
      $data_shopping_cart = $this -> paginate('Cart');
      if ($data_shopping_cart) {
        for ($i=0; $i < count($data_shopping_cart); $i++) {
          // - declare empty array
          $product_items = array();
          
          // - get items from the cart - not limited by pagination
          $product_items = $this->Cartitem->find("all", array(
            "conditions" => array(
              "cart_id" => $data_shopping_cart[$i]["Cart"]["id"]
            ),
            'joins'=>array(
          		// - join products to get the product name
          		array (
          			'type' => 'LEFT',
          			'table' => 'products',
          			'alias' => 'Details',
          			'conditions' => 'Cartitem.product_id = Details.id'
          		)
            ),
            'fields' => array(
              //全てのフィールド　select * from tablename; と同じ意味
          		'Cartitem.*',
          		'Details.*'
          	),
          ));
          
          // - add to products
          $data_shopping_cart[$i]["Cart"]["products"] = $product_items;
        }
      }
      
      //viewで使う変数の作成 $admin = $data
      $this->set('data_shopping_carts',$data_shopping_cart);
      // echo "<pre>";
      // var_dump($data_shopping_cart);
      // die();
      //--------------------------------------------
      
    }
  }
  
 ?>