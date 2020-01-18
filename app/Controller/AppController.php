<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
 
 
 
 // app/Controller/AppController.php
 class AppController extends Controller
 {
    
   public $uses = array(
     'Cart',
     'Product',
     'Cartitem'
   );
   
     public $components = array(
       'Session',
         'Flash',
         'Auth' => array(
             //ログイン時のリダイレクト
             'loginRedirect' => array(
                 //コントローラ選択
                 'controller' => 'toppage',
                 //action index() にリダイレクト
                 'action' => 'index'
             ),
             'logoutRedirect' => array(
                 'controller' => 'login',
                 'action' => 'index',
                 'home'
             ),
             'authenticate' => array(
                 'Form' => array(
                     'passwordHasher' => 'Blowfish'
                 )
             ),
             'authenticate' => array(
                  'Form' => array(
                      'fields' => array(
                        'username' => 'username',
                        'password' => 'password',
                      )
                  )
              ),    
             'authenticate' => array(
                 'Form' => array(
                     'scope' => array(
                       'user_type' => 'Normal User'
                     )
                 )
             ),
             'authenticate' => array(
                 'Form' => array(
                     'scope' => array(
                       'user_type' => 'admin'
                     )
                 )
             ),
             'authenticate' => array(
               'Form' => array(
                   'fields' => array(
                           'username' => 'username',
                           'password' => 'password'
                   ),
                   'userModel' => 'Login',
                )
             )
             // // この行を追加しました
             // 'authorize' => array('Controller')
         )
     );

     //beforefilterが子クラスから呼ばれたら
     public function beforeFilter()
     {
       
       // //<-日時取得->
       // //コンポーネントDateから値を取得
       // $now = $this->Date->today();
       // //Viewに$nowを渡す
       // $this->set('now', $now);
       
        // var_dump($this->Auth->User());
        // die();
        $this->set('current_user',$this->Auth->User());
        
        //user login it's working then work
        if($this->Auth->User('id'))
        {
          //cart_idから一致するデータを取得する
          //model cart からステータス0とuser_id(ログインユーザー)を取得
          $data = $this->Cart->find('first',array(
            "conditions" => array(
              'status' => '0',
              'user_id'=>$this->Auth->User('id')
              )
            )
          );
          //ログインデータから
          $this->set('current_cart',$data);
        }
          else 
          {
            //ログインしていないならtopに戻す
            // $this->redirect('http://localhost:8888/shopping/');
          }
          
        if($this->Auth->User('id'))
        {
          $prodata = $this->Product->find('all');
          // var_dump($prodata);
          $this->set('product_data',$prodata);
          
          $cartitemdata = $this->Cartitem->find('all');
          //
          // $this->set('cartitemdata',$cartitemdata);
        }
        
        
        
         //許可を出すindex,view に
         $this->Auth->allow(
           'index',
           'Admin',
           'view',
           'weapon_list',
           'users',
           'register',
           'edit',
           'delete',
           'products',
           'cart',
           'products_register',
           'cartitem',
           'buy'
         );
     }
     
     //
     public function isAuthorized($user)
     {
       // Admin can access every action
       if (isset($status) && $user == 'admin')
       {
           return true;
       }

       // デフォルトは拒否
       return false;
     }
     
     public function sql(){
      $sql = $this->getDataSource()->getLog();

      $this->log($sql);
      return $sql;
    }

 }
