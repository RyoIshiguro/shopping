<?php 
  // echo "<pre>";
  // var_dump($product['Details']['id']);
  // var_dump($current_user['id']);
  // var_dump($current_user['money']);
  // var_dump($product);
  // var_dump($cartitemdata);
 ?>

    
  
  <!-- shopping/details/index.ctp -->
  
  <div class="container-fluid shopping-cart-items" 
  custom_product_id="<?php echo $product['Details']['id']; ?>"
  current_user_id="<?php echo $current_user['id']; ?>"
  current_user_money="<?php echo $current_user['money']; ?>"
  >
   <div class="row" style="height:500px;">
     <div class="card mb-12" style="width: 100%; height:400px;margin:2.5%;">
       <div class="row no-gutters" style="height: 100%;">
         <div class="col-md-4">

          <img class="card-img-top" style="height:100%;" src="http://localhost:8888/shopping/img/<?php echo $product['Details']['img']; ?>" alt="">

         </div>
         <div class="col-md-8">
           <div class="card-body">
             <div class="" id="item_title_<?php echo $product['Details']['id']; ?>" style="width:100%">
               <h2>
                 <?php echo $product['Details']['name']; ?>
               </h2>
             </div>
             <hr>
             <br>
             <div class="" style=""><h3><?php echo $product['Details']['content']; ?></h3></div><br>
             <div class="" 
               style="color:blue;" >
               <h3>
                 $<span id="custom_product_price_<?php echo $product['Details']['id']; ?>" ><?php echo $product['Details']['price']; ?></span>
               </h3>
             </div>
             <br>
             <div class="" style="">Condition:<br><h4><?php echo $product['Details']['comment']; ?></h4></div><br>
             
             <form class="" action="" method="post">
               <select class="" name="count" type="submit"
                id="custom_product_quantity_<?php echo $product['Details']['id'] ?>" style="width:50px;">
                 <option name="count" value="1">1</option>
                 <option name="count" value="2">2</option>
                 <option name="count" value="3">3</option>
                 <option name="count" value="4">4</option>
                 <option name="count" value="5">5</option>
                 <option name="count" value="6">6</option>
                 <option name="count" value="7">7</opton>
                 <option name="count" value="8">8</option>
                 <option name="count" value="9">9</option>
                 <option name="count" value="10">10</option>
               </select>
               <button type="submit" name="button_cart" style="" value="1">Cart</button>
               <input type="hidden" name="cart" value="<?php echo $product['Details']['price']; ?>">
               
               
               
               <!-- button Buy  押すとモーダルが出る-->
               <button type="button" data-toggle="modal" data-target="#exampleModal" name="button_buy" style="" class="p" value="button_buy" id="btn_cart_buy" >Buy now</button>
               <!-- モーダルの設定 -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <!-- modal title -->
                       <h5 class="modal-title" id="exampleModalLabel"><?php echo $product['Details']['name']; ?></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <!-- modal body -->
                     <div class="modal-body parent_cart_buy">
                       
                       <h4><p><?php
                            //$dif = 計算式の答え(会員の残金)  会員の資金 - 製品の値段
                            $dif = $current_user['money'] - $product['Details']['price'] * $product['Details']['quantity'];
                            echo "<br>\n";
                            echo "Remaining balance: $dif";
                            echo str_repeat("&nbsp;",1); 
                            
                            //条件文 お金が足らない時はエラー文言を表示
                            if ($dif < 0) 
                            {
                              echo "not enough money, you have to earn money first.";
                            }
                          ?>
                         <h4></p>
                     </div>
                     
                     <!-- modal footer -->
                     <div class="modal-footer ">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                       
                       <!-- 条件文 お金が足らない時はボタンを押させない(disabled) -->
                       <!----------------------------------------------------------->
                       <?php if ($dif < 0) {  ?>
                         <button type="submit" class="btn btn-disabled" name="button_buy" value="button_buy" disabled>Buy</button>
                       <?php } else  { ?>  
                        <button type="submit" class="btn btn-primary" name="button_buy" value="button_buy" >Buy</button>
                       <?php  } ?>
                       <!----------------------------------------------------------->
                       
                     </div><!-- /.modal-footer -->
                   </div><!-- /.modal-content -->
                 </div><!-- /.modal-dialog -->
               </div><!-- /.modal -->
               <!----------------------------------------------------------->
               <!-- モーダル 一個ずつ買うよう-->
               
               <input type="hidden" name="user_money" value="<?php echo $dif ?>">
               
               <!-- <button type="submit" name="button_buy" style="" value="1">Buy now</button>
               <input type="hidden" name="buy" value="<?php 
               // echo $product['Details']['price']; 
               ?>"> -->
               
            </form>
           </div>
         </div>
       </div>
     </div>
   </div>
  </div>
  <script type="text/javascript">
    // - please wait until the page has loaded before doing the code inside this block
  $(document).ready(function()
  {
    $('#btn_cart_buy').on('click', function()
    {
      $(".parent_cart_buy").html('');
      
      $(".shopping-cart-items").each(function(index, element)
      {
        var current_user_id=$(element).attr("dcurrent_user_id");
        
        var current_user_money=$(element).attr("current_user_money");
        
        var custom_product_id = $(element).attr("custom_product_id");
        
        
        
        
        var title = $("#item_title_"+custom_product_id).html();
        
        var id = $("#custom_product_id_"+custom_product_id).html();
        
        var price = $("#custom_product_price_"+custom_product_id).html();
        
        var quantity = $("#custom_product_quantity_"+custom_product_id).val();
        
        var cart_amount = price * quantity;
        
        var calcurate = current_user_money - cart_amount;
        
        //class cartamount がある要素にHTMLを追加
        $(".parent_cart_buy").html(
          " Billing amount : " + " $ " + price + " × " + quantity + " = " + cart_amount + "<hr>"
          + current_user_money + "  -  " + cart_amount + "  =  " + calcurate + "<hr>" 
        );
        
        $(".total_amount_of_cart").html(
          " Total amount of cart : $ "
          + cart_amount + "<hr>"
        );
        
        // $('#modal_cart_buy_items').modal('show');
        
      });
    });
  });
    
  </script>
