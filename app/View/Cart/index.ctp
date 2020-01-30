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

 <!-- shopping/details/index.ctp -->
 <?php
  foreach ($cart_data as $cart_data) {
  ?>
  <div 
    class="container-fluid shopping-cart-items" 
    cart-item-id="<?php echo $cart_data['Cartitems']['id'] ?>"
    style="float:right;">
   <div class="row" style="height:400px;">
     <div class="card mb-12" style="width: 100%; height:300px;margin:2.5%;">
       <div class="row no-gutters" style="height: 300px;">
         <div class="col-md-4">

              <img class="card-img-top" style="height:300px;" src="http://localhost:8888/shopping/img/<?php echo $cart_data['Details']['img']; ?>" alt="">

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
                 <option value="1" selected >1</option>
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
               
               
                
               <!-- button Buy  押すとモーダルが出る-->
               <button 
                type="button" 
                name="buy" 
                style="" 
                class="btn_buy_item" 
                value="buy" 
                cart-item-id="<?php echo $cart_data['Cartitems']['id'] ?>">Buy now</button>      
                <!-- カスタムID（イメージは変数)　cart-item-id -->
                  
                  
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
      
      // please clear the container before we put anything inside
      //class parent_cart_buyを空にする
      $(".parent_cart_buy").html('');
      
      // perform loop on all the cart items
      //mother divのclassを回す。理由はidはユニークだから使用不可。idを元にするphp的な考えだとできない。
      $(".shopping-cart-items").each(function(index, element){
        // console.warn(index);
        // console.warn(element);
        // console.warn("@@@@@@");
        
        // get the id  
        var id = $(element).attr("cart-item-id");
        
        // get if item is checked
        var check = $("#checkbox_detail_id_"+id).prop("checked");
        
        // - get the ttitle and price based on the currently selected item
        var title = $("#item_title_"+id).html();
        var price = $("#item_price_"+id).html();
        //valueを取得したいので.valになる
        var quantity = $("#product_quantity_"+id).val();
        
        // if not checked, return true, skip next step
        if (check == false) 
        {
          return true;
        }
        
        // append
        $(".parent_cart_buy").append(title+ " - qty: " + quantity + " - price:" + price + "<br/>");
      });
      
      $('#modal_cart_buy_items').modal('show');
    });
    
    //$(".classname").on('event,select,data,functionを実行')
    $(".btn_buy_item").on("click", function()
    {
      
      // - get ID
      var id = $(this).attr("cart-item-id");
        
      // - get the ttitle and price based on the currently selected item
      var title = $("#item_title_"+id).html();
      var price = $("#item_price_"+id).html();
      var check = $("#checkbox_detail_id_"+id).html();
      var quantity = $("#product_quantity_"+id).val();
      alert(quantity)
      
      alert($("#checkbox_detail_id_"+id).prop("checked") );
      
      if ($("#checkbox_detail_id_"+id).prop("checked") == true) 
      {
        $(".money_remaining").html("チェック項目1がチェックされています。<br/>");
        } 
          else 
          {
            $(".money_remaining").html("チェック項目1がチェックされていません。<br/>");
          }
      
      // if(!$('.checkbox_detail_id_').prop('checked'))
      // {
      //   (".money_remaining").html("チェック項目1がチェックされていません。<br/>");
      // }
      
      // - set the display items
      $(".product_title").html(title);
      $(".money_product_price").html(price);
      
      // - last step, show modal
      // - manually show modal!!!!
      // - https://getbootstrap.com/docs/4.0/components/modal/
      $('#exampleModal').modal("show");
      
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