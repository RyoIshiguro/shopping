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
                //完全一致検索にする場合は'%'を外して変数だけ渡す。
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
      
      //if it has value  0はfalse と判定される。のでmb_strlen()とする
      //phpやjavascript で０の扱いはfalseのため
      if(mb_strlen($this->request->query('status')))
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
      
      //created_datetime  search 
      //--------------------------------------------
      if($this->request->query('created_datetime'))
      {
        //getの中身 あいまい検索ではpostは使わない get した内容を受け取るのが$test
        $test =  $this->request->query('created_datetime');
        
        $array_conditions = array();
        //デバグ
        // echo "<pre>";
        // var_dump($test);
        // echo "<br>\n";
        // die();
        
        //$testの秒をカットして変数に格納
        //echo date("ymd",$hoge); とするとA non well formed numeric value encountered 「ちゃんと整形されてない数値があるよ」が返ってくるのでstrtotime(hoge);で整形してから行う
        $format_style = strtotime($test);
        // var_dump($format_style);
        // echo "<br>\n";
        // die();
        
        
        //strtotime参考https://wepicks.net/phpsample-date-format/
        //秒を00に指定する
        $format_ymd = date("Y-m-d 00:00:00" , strtotime($test));
        $format_ymd_59 = date("Y-m-d 23:59:59" , strtotime($format_ymd."+59 second"));
        //デバグ用
        // var_dump($format_ymd );
        // echo "<br>\n";
        // var_dump($format_ymd_59 );
        // echo "<br>\n";
        // die();
        // 
        //$format_ymdを使って範囲検索 00-59sで検索したい。もしくは00-60s
        
        
        //original
        // $this->paginate = array(
        //         'paramType'=>'querystring',
        //         'limit'=>25,
        //         'order' => array(
        //         'id desc'
        //       ),
        //       'conditions' => array(
        //         array(
        //           'or' => array(
        //         array('Cart.created_datetime like' => '%'.$test.'%')
        //       )
        //     )
        //   )
        // );
        
        //範囲検索
        $this->paginate = array(
                'paramType'=>'querystring',
                'limit'=>25,
                'order' => array(
                'id desc'
              ),
              'conditions' => array(
                array(
                  'or' => array(
                array(
                    'created_datetime BETWEEN ? and ?' => array($format_ymd,$format_ymd_59 
                  )
                )
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
      //created_datetime search 
      
      //paid_datetime  search 
      //--------------------------------------------
      if($this->request->query('paid_datetime'))
      {
        //getの中身 あいまい検索ではpostは使わない get した内容を受け取るのが$test
        $test =  $this->request->query('paid_datetime');
        
        $array_conditions = array();
        //デバグ
        // echo "<pre>";
        // var_dump($test);
        // die();
        
        $format_style = strtotime($test);
        // var_dump($format_style);
        // echo "<br>\n";
        // die();
        
        $format_ymd = date("Y-m-d 00:00:00" , strtotime($test));
        $format_ymd_59 = date("Y-m-d 23:59:59" , strtotime($format_ymd."+59 second"));
        //デバグ用
        // var_dump($format_ymd );
        // echo "<br>\n";
        // var_dump($format_ymd_59 );
        // echo "<br>\n";
        // die();
        
        //範囲検索
        $this->paginate = array(
                'paramType'=>'querystring',
                'limit'=>25,
                'order' => array(
                'id desc'
              ),
              'conditions' => array(
                array(
                  'or' => array(
                array(
                    //ここの解説の意味を理解すること
                    'paid_datetime BETWEEN ? and ?' => array($format_ymd,$format_ymd_59 
                  )
                )
              )
            )
          )
        );
        
        //デバグ
        // echo "<pre>";
        // var_dump($data);
        // die();
        
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
      //paid_datetime search 
      
    }
    
    function sales()
    {
      //使用するレイアウト
      $this->layout = "admin";
      
      $product_name = $this->Product->find('all');
      //デバグ
      // echo "<pre>";
      // var_dump($product_name);
      // die();
      
      $cart_items = $this->Cartitem->find('all');
      // echo "<pre>";
      // var_dump($cart_items);
      // die();
      
      //今日の日付
      $day_data = date('Y-m-d');
      
      //西暦と月
      $yeardate = date('Y-m');
      //デバグ
      // echo "<pre>";
      // echo $yeardate;
      // echo "<br>\n";
      // die();
      $this->set('yeardate',$yeardate);
      
      
      //デバグ
      // echo $day_data;
      
      $this->set('day_data',$day_data);
      
      //月初 ※strtotimeの第二引数がnullだと1970や6800が表示される
      $first_date = date('Y-m-d',strtotime($day_data));
      //月末
      $last_date = date('Y-m-t',strtotime($day_data));
      
      //デバグ
      // echo "<br>\n";
      // echo $first_date."<br>\n";
      // echo $last_date."<br>\n";
      $this->set('first_date',$first_date);
      $this->set('last_date',$last_date);
      
      //日付取得
      //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
      // $date = '2015-12'; //本来はformからのリクエストなので動的
      // $begin = new DateTime(date('Y-m-d', strtotime('first day of '. $date)));
      // $end = new Datetime(date('Y-m-d', strtotime('first day of next month '. $date)));
      // $interval = new DateInterval('P1D');
      // $daterange = new DatePeriod($begin, $interval, $end);
      // foreach($daterange as $date){
      //   echo $date->format("Y-m-d") . "\n";
      // }
      //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
      //日付取得
      
        if($this->request->query('year_date'))
        {
          $date = $this->request->query('year_date');
          // var_dump($date) ;
          // die();
          
          //タイムスタンプstrototimeは英語で指定も可能
          $begin = new DateTime(date('Y-m-d', strtotime('first day of '. $date)));
          $string_begin = $begin->format('Y-m-d');
          $this->set('begin',$string_begin);
          //デバグ
          print($string_begin); echo "<br>\n";
          
          $end = new Datetime(date('Y-m-d', strtotime('first day of next month '. $date)));
          $string_end = $end->format('Y-m-d');
          $this->set('end',$string_end);
          //デバグ
          print($string_end);
          // die();
          
          //時間の感覚を一日ずづで指定
          $interval = new DateInterval('P1D');
          
          //
          $daterange = new DatePeriod($begin, $interval, $end);
          // debug($daterange);
          // echo "<pre>";
          // var_dump($daterange);
          
          $this->set('daterange',$daterange);
          // echo "<pre>";
          // var_dump($daterange);
        } 
          else 
          {
            //デフォルト。最初に画面に遷移した時に値が入ってなくてエラーになるの防止
            $date = date('Y-m-d');
            
            // var_dump($date);
            // die();
            
            //タイムスタンプstrototimeは英語で指定も可能
            $begin = new DateTime(date('Y-m-d', strtotime('first day of '. $date)));
            
            $end = new Datetime(date('Y-m-d', strtotime('first day of next month '. $date)));
            // デバグ
            // echo $begin = $begin->format('Y-m-d'); echo "<br>\n"; 
            // echo $end = $end->format('Y-m-d');;
            // die();
            
            //時間の感覚を一日ずづで指定
            $interval = new DateInterval('P1D');
            
            //
            $daterange = new DatePeriod($begin, $interval, $end);
            // echo "<pre>";
            // var_dump($daterange);
            
            $this->set('daterange',$daterange);
            // echo "<pre>";
            // var_dump($daterange);
          }
        //デバグ
        // echo "<pre>";
        // var_dump($daterange);
        // die();
      
      // $rowdate = $daterange->format("Y-m-d");
      // echo "<pre>";
      // echo $rowdate;
      // die();
      
      $begin = new DateTime(date('Y-m-d', strtotime('first day of '. $date)));
      $string_begin = $begin->format('Y-m-d');
      var_dump($begin);
      
      $end = new Datetime(date('Y-m-d', strtotime('first day of next month '. $date)));
      var_dump($end);
      
      $period = array();
      for ($i=$begin; $i <= $end; $i++) {
        // $period[] = date('Y-m-d',$begin.'+'.$i); 
        $year = substr($i, 0,4);
        $month = substr($i, 4,2);
        $day = substr($i, 6,2);
     
        if(checkdate ( $month , $day , $year ))
        $days[] = date('Y-m-d', strtotime($i));
      }
      return $days;
      // var_dump($period);
      die();
      
      foreach ($daterange as $dateranges)
      {
        //入力した日付 or 指定月の日付
        print($dateranges->format('Y-m-d')); echo "<br>\n";
        $daterange_data = $dateranges->format('Y-m-d');
      }
      //デバグ
      // echo "<pre>";
      // var_dump($daterange_data);
      // die();
      
      foreach ($cart_items as $alldata)
      {
        //shopping_cart_itemsのpaid_datetimeを取得
        print(date("Y-m-d", strtotime($alldata['Cartitem']['paid_datetime'])));echo "<br>\n";
        
        //shopping_cart_itemsのpaid_datetime をY-m-d 表示に変換
        $paid_datetime = date("Y-m-d", strtotime($alldata['Cartitem']['paid_datetime']));
        
        //デバグ
        // echo "<pre>";
        // var_dump($paid_datetime);
        // die();
        
      }
      
      print_r(array_intersect($daterange_data,$paid_datetime));
      
      // foreach ($daterange as $dateranges) 
      // {
      //   if($daterange_data == $paid_datetime)
      //   {
      //     echo "hello";
      //   }
      // }
      
      
      // foreach ($cart_items as $alldata){
      //   date("Y-m-d H:i:s", strtotime($alldata['Cartitem']['paid_datetime']));
      //   if ($rowdate == date("Y-m-d",  strtotime($alldata['Product']['paid_datetime']))) {
      //     echo "Hello";
      //   }
      // }
      die();
      
      $cart_items_paid_datetime = $this->Cartitem->find('all',array(
        'conditions' => array(
          'product_id' => '3',
          'paid_datetime' => $cart_items_paid_datetime['Cartitem']['paid_datetime']
        )
      ));
      // echo "<pre>";
      // var_dump($cart_items_paid_datetime);
      // die();
      
      
      //日付
      // foreach ($product_name as $alldata)
      // {
      //   date("Y-m-d H:i:s", strtotime($alldata['Product']['paid_datetime']));
      // 
      //   //行データ
      //   $rowdate = $dateranges->format("Y-m-d");
      // 
      //   if ($rowdate == date("Y-m-d", strtotime($alldata['Product']['paid_datetime']))) 
      //   {
      //     echo "Hello";
      //   }
      // }
      
      $cart_items = $this->Cartitem->find('all',array(
        "condition" => array(
          'paid_datetime' => $dataname['Cartitem']['paid_datetime']
        )
      ));
      $this->set('product_name',$product_name);
      //デバグ
      // echo "<pre>";
      // var_dump($product_name);
      // die();
      
      
    
      
      //table = shopping_cart_items 
      $product_sale_data = $this->Cartitem->find('all');
      $this->set('product_sale_data',$product_sale_data);
      //デバグ
      // echo "<pre>";
      // var_dump($product_sale_data);
      // die();
      
      $sql_daterange = $this->Cartitem->query("select * from shopping_cart_items where product_id='3' AND paid_datetime BETWEEN '2020-01-01 00:00:00' AND '2020-01-31 00:00:00'");
      
      $this->set('sql_daterange',$sql_daterange);
      // echo "<pre>";
      // var_dump($sql_daterange);
      // die();
      
      
      // $product_sales = $this->Product->find('first',array(
      //   'conditions' => array(
      //     'Cartitem.product_id' => "SELECT * FROM `products` WHERE id",
      //     'Cartitem.price' =>  
      //   )
      // ));
      
      
        
        
      
      
      $sales_mannagment = $this->Cart->find('all', array(
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
      
      //デバグ
      // echo "<pre>";
      // var_dump($sales_mannagment);
      // die();
      $this->set('sales_mannagment',$sales_mannagment);
      
    }
    
  }
 ?>