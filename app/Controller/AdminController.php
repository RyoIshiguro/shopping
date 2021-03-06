<?php 
  //App::uses('クラス名','パッケージ名');AppController.phpの中にある
  App::uses('AppController','Controller');
  
  

  class AdminController extends AppController
  {
    
    public $uses = array(
      'Admin',
      'Product'
    );
    
    function index()
    {
      $this->layout = "admin";
      // echo "Hello Admin";
    }
    
    function weapon_list() 
    {
      $this->layout = "admin";
    }
    
    
    function users() 
    {
      //使用するlayoutを指定
      $this->layout = "admin";
      //あとで使用するのでからの配列を作る
      $array_conditions = array();
      //全データをゲットして$dataとしておく
      $data = $this->request->query;
      
      // pegination
      //----------------------------------------
      //降順でページネーションを作成。
      $this -> paginate = array(
        //URlにパラメータを送信するクエリ型にする「?」+「変数名」+「=」+「変数の値」というのが、クエリパラメータの基本構造
        'paramType' => 'querystring',
        //表示限界を決める10個分のデータを表示
        'limit' => 5,
        //表示順
        'order' => array(
          //降順
          'id desc'
        ),
        'conditions' => array(
          
        )
      );
      
      // //paginate これがcomponent pagination これがthis-> Admin ->find('all');をしなくてもデータ取得ができる仕組み
      $data = $this -> paginate('Admin');

      //viewで使う変数の作成 $admin = $data
      $this->set('admin',$data);
      //pagination
      //----------------------------------------
      
    }
    
    function delete()
    {
      //使用するlayoutを指定
      $this->layout = "admin";
      
      $id = $this->request->query('id');
      // var_dump($id);
      // die();
      
      //model Adminの$idにdeleteメソッド
      //$id
      if($this -> Admin -> delete($id))
      {
        //deleteに成功したらメッセージを表示
        $this -> Flash -> success(
          __('The post with id: %s has been deleted.',h($id))
        );
      }
      else
      {
        //deleteに失敗したらメッセージを表示
        $this -> Flash -> error(
          __('The pst with id: %s could not be deleted.',h($id))
        );
      }

      //action index()メソッドへリダイレクトさせる
      return $this -> redirect('http://localhost:8888/shopping/admin/users/');

    }
    
    function edit()
    {
      //使用するlayoutを指定
      $this->layout = "admin";
      
      // get
      $data = $this -> request -> query;
      //上のデータからidをしたもの
      $id = $data['id'];

      if($this -> request -> is('post'))
      {
        $user_edit = $this -> request -> data;

        //for update
        $this -> Admin -> read(null,$id);

        $this -> Admin ->set(array(
          'first_name' => $user_edit['first_name'],
          'last_name' => $user_edit['last_name'],
          'username' => $user_edit['username'],
          'email' => $user_edit['email'],
          'user_type' => $user_edit['user_type'],
          'money' => $user_edit['money']
        ));
        //ここでtableに保存する
        //$userはデバッグ用
        $user = $this -> Admin -> save();
        // var_dump($user);
        
        ////セッションに書き込み Auth.model.field,にfieldに$this->request->data('')を保存する(更新)
        $this->Session->write('Auth.User.money', $this->request->data('money'));
        
        //$current_user['']はpostされたデータに書き換える
        $current_user['money'] = $this->request->data('money');

        //edit押すとリダイレクトさせる
        $this -> redirect('http://localhost:8888/shopping/admin/users/');
      }
      //最初一行目を取得する emp_no の先頭
      $admin = $this -> Admin -> find('first',array(
        "conditions" => array(
          'id' => $id
        )
      ));
      // var_dump($employee);
      //viewで使う$employeeを作成
      $this -> set('admin', $admin);
    }
    
    function register()
    {
      
      //使用するlayoutを指定
      $this->layout = "admin";
      
      // echo "Hello Loophole";echo "<br>\n";
      if($this->request->is('post'))
      {
        
        
        if($userTable = 'users')
        {
          //デバグ用
          // echo "correct";
          // echo "<pre>";
          // var_dump($this->Loophole->find('all')); 
          // debug($this->request->data);
          // die();
        }
        
    
        $this->Admin->create();
        $data = $this->request->data;
        // $this->Loophple->set($data);
        var_dump($data);
        //if($this->Loophole->save($data,false)として第二引数にfalseを渡すとvalidationを無視することが可能
        if($this->Admin->save($data))
        {
          $this->Flash->success(__('The Admin has been saved.'));
          // return $this->redirect(array('action' => 'index'));
          return $this->redirect('http://localhost:8888/shopping/admin/users/');
        }else{
          $this->Flash->error(__('The Admin could not be saved. Please, try again.'));
        }
      }
      
    }
    
    function products()
    {
      //使用するlayoutを指定
      $this->layout = "Admin";
      //あとで使用するのでからの配列を作る
      $array_conditions = array();
      //全データをゲットして$dataとしておく
      $data = $this->request->query;
      
      // pegination
      //----------------------------------------
      //降順でページネーションを作成。
      $this -> paginate = array(
        //URlにパラメータを送信するクエリ型にする「?」+「変数名」+「=」+「変数の値」というのが、クエリパラメータの基本構造
        'paramType' => 'querystring',
        //表示限界を決める10個分のデータを表示
        'limit' => 5,
        //表示順
        'order' => array(
          //降順
          'id desc'
        ),
        'conditions' => array(
          
        )
      );
      
      // //paginate これがcomponent pagination これがthis-> Admin ->find('all');をしなくてもデータ取得ができる仕組み
      $data = $this -> paginate('Product');

      //viewで使う変数の作成 $admin = $data
      $this->set('product',$data);
      //pagination
      //----------------------------------------
      
    }
    
    function products_edit()
    {
      //使用するlayoutを指定
      $this->layout = "admin";
      
      // get
      $data = $this -> request -> query;
      
      //上のデータからidをしたもの
      $id = $data['id'];

      if($this -> request -> is('post'))
      {
        $product_edit = $this -> request -> data;
        // echo "<pre>";
        // var_dump($product_edit);
        // die();

        //for update
        $this -> Product -> read(null,$id);

        $this -> Product ->set(array(
          'name' => $product_edit['name'],
          'content' => $product_edit['content'],
          'price' => $product_edit['price'],
          'comment' => $product_edit['comment'],
          'img' => $product_edit['img']
        ));
        //ここでtableに保存する
        //$userはデバッグ用
        $user = $this -> Product -> save();
        // var_dump($user);

        //update押すとリダイレクトさせる
        $this -> redirect('http://localhost:8888/shopping/admin/products/');
      }
      //最初一行目を取得する emp_no の先頭
      $product = $this -> Product -> find('first',array(
        "conditions" => array(
          'id' => $id
        )
      ));
      // var_dump($product);
      //viewで使う$productsを作成
      $this -> set('products', $product);
    }
    
    function produect_delete()
    {
      //使用するlayoutを指定
      $this->layout = "admin";
      //is('get') 現在のリクエストが GET かどうかを調べます。
      //フォームからゲットされたデータがあるかどうか
      // if($this -> request ->is('get'))
      // {
      //   //取り扱い不明 メソッドが無かった時？
      //   throw new MethodNotAllowedExption();
      // }
      $id = $this->request->query('id');
      // var_dump($id);
      // die();
      //model Productの$idにdeleteメソッド
      //$id
      if($this -> Product -> delete($id))
      {
        //deleteに成功したらメッセージを表示
        $this -> Flash -> success(
          __('The post with id: %s has been deleted.',h($id))
        );
        
        //action index()メソッドへリダイレクトさせる
        return $this -> redirect('http://localhost:8888/shopping/admin/products/');

      }
      else
      {
        //deleteに失敗したらメッセージを表示
        $this -> Flash -> error(
          __('The pst with id: %s could not be deleted.',h($id))
        );
      }

      
    }
    
    function products_register()
    {
      //使用するlayoutを指定
      $this->layout = "admin";
      
      //is('post') 現在のリクエストが POST かどうかを調べます。
      //フォームからポストされたデータがあるかどうか
      if($this -> request -> is('post'))
      {
        var_dump($this->request->data);
        $post = $this->request->data;
        
        //こうすることでcreate先のmodelを指定できる
        // $post['Product'] = $this->request->data['Admin'];
        
        //model Productにデータを作成するよ
        $this -> Product -> create();
        
        // $this->request->data['Product']['id'];

        // $this->request->data['Product']['id'] = $this->Auth->user('id');

        if ($this -> Product -> save($post))
        {
          //保存成功したらメッセージを表示
          $this -> Flash -> success(__('Your post has been save.'));

          //action index()メソッドへリダイレクトさせる
          return $this ->redirect('http://localhost:8888/shopping/admin/products/');
        }

        //保存失敗したらメッセージを表示
        $this -> Flash -> error(__('Unable to add your post.'));
      }
    }
    
    function cart_history()
    {
      //使用するlayoutを指定
      $this->layout = "admin";
      
      $data = $this->request->query;  
      
      // pegination
      //----------------------------------------
      //降順でページネーションを作成。
      $this -> paginate = array(
        //URlにパラメータを送信するクエリ型にする「?」+「変数名」+「=」+「変数の値」というのが、クエリパラメータの基本構造
        'paramType' => 'querystring',
        //表示限界を決める10個分のデータを表示
        'limit' => 25,
        //表示順
        'order' => array(
          //降順
          'id desc'
        ),
        'conditions' => array(
          
        )
      );
      
      // //paginate これがcomponent pagination これがthis-> Admin ->find('all');をしなくてもデータ取得ができる仕組み
      $data = $this -> paginate('Cart');

      //viewで使う変数の作成 $admin = $data
      $this->set('Carts_history',$data);
      //pagination
      //---------------------------------------- 
      
      //user_id search 
      //--------------------------------------------
      if($this->request->query('user_id'))
      {
        //getの中身 あいまい検索ではpostは使わない get した内容を受け取るのが$test
        $test =  $this->request->query('user_id');
        
        $array_conditions = array();
        //デバグ
        // echo "<pre>";
        // var_dump($test);
        // die();
        
        $this->paginate = array(
                'paramType'=>'querystring',
                'limit'=>25,
                'order' => array(
                'id desc'
              ),
              'conditions' => array(
                array(
                  'or' => array(
                array('Cart.user_id like' => '%'.$test.'%')
              )
            )
          )
        );
        
        // //paginate これがcomponent pagination これがthis-> Employee ->find('all');をしなくてもデータ取得ができる仕組み
        $data = $this->paginate('Cart');
        
        //デバグ
        // echo "<pre>";
        // var_dump($data);
        // die();
        
        //viewで使う変数の作成 $employees = $data
        $this->set('Carts_history',$data);
      }  
      //--------------------------------------------
      //user_id search 
      
      //status search 
      //--------------------------------------------
      if($this->request->query('status'))
      {
        //getの中身 あいまい検索ではpostは使わない get した内容を受け取るのが$test
        $test =  $this->request->query('status');
        
        $array_conditions = array();
        //デバグ
        // echo "<pre>";
        // var_dump($test);
        // die();
        
        $this->paginate = array(
                'paramType'=>'querystring',
                'limit'=>25,
                'order' => array(
                'id desc'
              ),
              'conditions' => array(
                array(
                  'or' => array(
                array('Cart.status like' => '%'.$test.'%')
              )
            )
          )
        );
        
        // //paginate これがcomponent pagination これがthis-> Employee ->find('all');をしなくてもデータ取得ができる仕組み
        $data = $this->paginate('Cart');
        
        //デバグ
        // echo "<pre>";
        // var_dump($data);
        // die();
        
        //viewで使う変数の作成 $employees = $data
        $this->set('Carts_history',$data);
      }  
      //--------------------------------------------
      //status search 
      
      //price search 
      //--------------------------------------------
      if($this->request->query('price'))
      {
        //getの中身 あいまい検索ではpostは使わない get した内容を受け取るのが$test
        $test =  $this->request->query('price');
        
        $array_conditions = array();
        //デバグ
        // echo "<pre>";
        // var_dump($test);
        // die();
        
        $this->paginate = array(
                'paramType'=>'querystring',
                'limit'=>25,
                'order' => array(
                'id desc'
              ),
              'conditions' => array(
                array(
                  'or' => array(
                array('Cart.price like' => '%'.$test.'%')
              )
            )
          )
        );
        
        // //paginate これがcomponent pagination これがthis-> Employee ->find('all');をしなくてもデータ取得ができる仕組み
        $data = $this->paginate('Cart');
        
        //デバグ
        // echo "<pre>";
        // var_dump($data);
        // die();
        
        //viewで使う変数の作成 $employees = $data
        $this->set('Carts_history',$data);
      }  
      //--------------------------------------------
      //price search 
      
      
      
    }
    
  }
 ?>