<style media="screen">
  .p{
    margin-bottom: 5px;
  }
  .container-fluid{
    /* float: left; */
  }
  .modal-dialog{
    z-index: 100;
  }
</style>

<?php 
  // foreach ($cart as $carts) {
  //   // code...
  // }
  
  // echo $products;
  // echo '本日の日付は'.$now.'です。';
  
  //joinされた配列の取得
  // echo "<pre>";
  // mulutiple index array   $valuename[array of number][model][feild];
  // var_dump($cart_data['0']['Details']['img']);
  // var_dump($product_data);
 ?>
 
 <!-- <p><time datetime="2020-02-07">2020-02-07</time></p>
 <p><time datetime="2020-02-07T12:00">2020年2月27日</time></p>
 <p><time>tomorrow</time></p> -->
 <!-- shopping/details/index.ctp -->
 <?php
  foreach ($cart_data as $cart_data) {
  ?>
  <div 
    class="container-fluid shopping-cart-items" 
    cart-item-id="<?php echo $cart_data['Cartitems']['id']; ?>"
    current_user_id="<?php echo $current_user['id']; ?>"
    current_user_money="<?php echo $current_user['money']; ?>"
    cart_product_id="<?php echo $cart_data['Details']['id']; ?>"
    cart_id="<?php echo $cart_data['Cartitems']['cart_id']; ?>"
    style="float:right;">
   <div class="row" style="height:400px;">
     <div class="card mb-12" style="width: 100%; height:300px;margin:2.5%;">
       <div class="row no-gutters" style="height: 300px;">
         <div class="col-md-4">

              <img class="card-img-top" style="height:300px;"
               src="http://localhost:8888/shopping/img/<?php echo $cart_data['Details']['img']; ?>" alt="">

         </div>
         <div class="col-md-8">
           <div class="card-body">
             <div class="p" style="width:100%">
               <!-- title of product -->
               <!-- id＝””はユニーク変数 item_title_blablaを格納-->
               <!-- class＝””は共通変数 -->
               <span class="item_title" id="item_title_<?php echo $cart_data['Cartitems']['id'] ?>"><?php  echo $cart_data['Details']['name']; ?></span>
               
               <!-- checkbox -->
               <input type="checkbox" name="check" id="checkbox_detail_id_<?php echo $cart_data['Cartitems']['id'] ?>" value="1" style="margin-left: 25px;">
             </div>
             <hr>
             
             <div class="p" style=""><?php echo $cart_data['Details']['content']; ?></div>
             <div class="p item_price" style="color:blue;">
               $ <span id="item_price_<?php echo $cart_data['Cartitems']['id'] ?>"><?php echo $cart_data['Details']['price']; ?></span>
             </div>
             <div class="p" style="">Condition:<br><?php echo $cart_data['Details']['comment']; ?></div>
             <br>
             
             <form class="" action="" method="post">
               
               <!-- <input type="option" name="count" style="width:100px;" class="p" placeholder="count" value="1"></input> -->
               <select class="" name="count" type="submit" style="width:50px;" id="product_quantity_<?php echo $cart_data['Cartitems']['id'] ?>">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                 <option value="6">6</option>
                 <option value="7">7</opton>
                 <option value="8">8</option>
                 <option value="9">9</option>
                 <option value="10">10</option>
               </select>
               
               <!-- <button 
                 type="submit" 
                 name="buy"
                 ass="list-group-item list-group-item-action" 
                 id="btn_cart_buy" 
                 value="buy"
               >
               Buy
              </button> -->
               
                  
              <!-- delete button -->
               <button 
                type="submit" 
                name="delete" 
                id="porduction_delete_" 
                class="btn_delete_item" 
                btn_delete_item_id="<?php echo $cart_data['Cartitems']['id'] ?>"
                value="delete">
                Delete
              </button>
              <!-- delete button -->
               
               <!-- ↓のやり方で値を隠せる -->
               <!-- <input type="hidden" name="user_money" value="<?php echo $dif ?>"> -->
               <input type="hidden" name="detail_id" value="<?php echo $cart_data['Cartitems']['id'] ?>">
               <input type="hidden" name="cart_id" value="<?php echo $cart_data['Cart']['id'] ?>">
             </form>

           </div>
         </div>
       </div>
       
     </div>
   </div>
  </div>
  <?php
    }
   ?>
<script type="text/javascript">
  // - please wait until the page has loaded before doing the code inside this block
  $(document).ready(function()
  {
      //jqueryのデバグは一個何かを足したらすること！！マジで原因を見失うから。
    // this alert for debug!!!!!
    // alert('hello');
    
    
    //ボタンカートがトリガー（id=btn_cart_buyを押す)
    $('#btn_cart_buy').on('click', function()
    {
      var amount_total = 0;
      var user_money = 0;
      
      //変数 has_items に falseとする
      var has_items = false;
      
      // please clear the container before we put anything inside
      //class parent_cart_buyを空にする
      //$('body').html('こんにちは！'); body内に文字を出力可能
      $(".parent_cart_buy").html('');
      //HTMLのリセット。ループの時に重複するから。
      $("#container_items").html('');
      // perform loop on all the cart items
      //motherdivのclassを回す。理由はidはユニークだから使用不可。idを元にするphp的な考えだとできない。
      //for each をclass = shopping-cart-itemsにかけている
      //function( index, Element )
      // マッチした各要素に対し、繰り返し実行するコールバック関数。
      // 「false」返すと、繰り返し処理を中止する。
      // 「true」返すと、次の繰り返し処理に移る。
      // index  「0」から始まるインデックス番号。
      // Element  現在マッチしているDOM要素。
      $(".shopping-cart-items").each(function(index, element)
      {
        // console.warn(index);
        // console.warn(element);
        // console.warn("@@@@@@");
        
        // get the id  div等の要素からカスタムidを取得している
        var id = $(element).attr("cart-item-id");
        var user_id = $(element).attr("current_user_id");
        user_money = $(element).attr("current_user_money");
        var product_id = $(element).attr("cart_product_id");
        var cart_id = $(element).attr("cart_id");
        
        // get if item is checked  チェックボックスにチェックが入っているか確認する
        var check = $("#checkbox_detail_id_"+id).prop("checked");
        
        // - get the ttitle and price based on the currently selected item
        var title = $("#item_title_"+id).html();
        var price = $("#item_price_"+id).html();
        
        //valueを取得したいので.valになる
        var quantity = $("#product_quantity_"+id).val();
        
        //計算式の答え
        var cart_amount = price * quantity;
        
      
        if (check == false) 
        {
          // return true;
          // ループの中にあるのでid分出てしまう。
          // return alert('Please select weapon.');
        } 
        else 
        {
          //ループがif文に到達。チェックボックスの返り値（check)がtrueだった
          
          //has_itemsをtrueに書き換える
          has_items = true;
          
          // always increment amount_total on every loop
          //ループでここを通過するたびに足し算を行う。
          amount_total = amount_total + cart_amount;
          
          // ✔︎の数だけ追加
          //✔︎商品の数と値段をモーダルに表示
          $(".parent_cart_buy").append(
            title + " : $: " + price + " × " + quantity + " = " + cart_amount + "<hr>"
            );
          
          //✔︎の数だけ追加
          //controller にformで送るための設定
          //product_idを送る product_id[]は配列という意味になる
          //ループの中に入れると一つず入る
          $("#container_items").append(
            "<input type='hidden' name='cart_id[]' class='' value='" + id +"'>"
          )
          //product_idを送る product_quantity[]は配列という意味になる
          //ループの中に入れると一つず入る
          $("#container_items").append(
            "<input type='hidden' name='product_quantity[]' class='' value='" + quantity +"'>"
          )
          
          $("#container_items").append(
            "<input type='hidden' name='user_id[]' class='' value='" + user_id +"'>"
          )
          
          $("#container_items").append(
            "<input type='hidden' name='product_price[]' class='' value='" + price +"'>"
          )
          
          $("#container_items").append(
            "<input type='hidden' name='product_id[]' class='' value='" + product_id +"'>"
          )
          
          $("#container_items").append(
            "<input type='hidden' name='parent_cart_id[]' class='' value='" + cart_id +"'>"
          )
          
          $("#container_items").append(
            "<input type='hidden' name='user_money' class='' value='" + user_money +"'>"
          )
          
          $("#container_items").append(
            "<input type='hidden' name='cart_amount_total[]' class='' value='" + amount_total +"'>"
          )
          
        }
        
      });
      
      //has_itemsがあるなら
      if (has_items) {
        //計算式の答え  current_user_money - 支払額
        var calcurate = user_money - amount_total;
        
        //class cartamount がある要素にHTMLを追加
        $(".cartamount").html(
          " Billing amount : $ " 
          + user_money + "  -  " + amount_total + "  =  " + calcurate
        );
        
        $(".total_amount_of_cart").html(
          " Total amount of cart : $ "
          + amount_total 
        );
        
        
        // $("#container_items").append(
        //   "<input type='hidden' name='cart_amount_total[]' class='' value='" + amount_total +"'>"
        // )
        
        $('#modal_cart_buy_items').modal('show');
      }
    });
    
    
  });
  
  //$('class').on(クリックしたら,function)
  $(".btn_delete_item").on("click", function()
  {
    // - deleteボタンを押すとID取得
    //attrはidを取得したりhrefを設定したりなど、HTML属性の取得、複数の属性の設定、
    //btn_delete_item_id<php echo $cart_data['Cartitems']['id'] ?>
    //ここでは↑カスタムIDの内容を取得。
    var id = $(this).attr("btn_delete_item_id");
    
    //alertを使ってidの中身をデバグ
    alert(id);
    
  });
  
</script>


 <!-- </form> -->