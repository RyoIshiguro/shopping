<?php 
  // echo "<pre>";
  // var_dump($product['Details']['id']);
  // var_dump($product);
  // var_dump($cartitemdata);
 ?>

    
  
  <!-- shopping/details/index.ctp -->

  <div class="container-fluid">
   <div class="row" style="height:500px;">
     <div class="card mb-12" style="width: 100%; height:400px;margin:2.5%;">
       <div class="row no-gutters" style="height: 100%;">
         <div class="col-md-4">

          <img class="card-img-top" style="height:100%;" src="http://localhost:8888/shopping/img/<?php echo $product['Details']['img']; ?>" alt="">

         </div>
         <div class="col-md-8">
           <div class="card-body">
             <div class="" style="width:100%"><h2><?php echo $product['Details']['name']; ?></h2></div>
             <hr>
             <br>
             <div class="" style=""><h3><?php echo $product['Details']['content']; ?></h3></div><br>
             <div class="" style="color:blue;"><h3>$<?php echo $product['Details']['price']; ?></h3></div><br>
             <div class="" style="">Condition:<br><h4><?php echo $product['Details']['comment']; ?></h4></div><br>
             
             <form class="" action="" method="post">
               <button type="submit" name="button_cart" style="" value="1">Cart</button>
               <input type="hidden" name="cart" value="<?php echo $product['Details']['price']; ?>">
               
               <!-- button Buy  押すとモーダルが出る-->
               <button type="button" data-toggle="modal" data-target="#exampleModal" name="button_buy" style="" class="p" value="button_buy">Buy now</button>
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
                     <div class="modal-body">
                       <h2><p style="color:blue;"><?php 
                            echo $current_user['money'];
                            echo str_repeat("&nbsp;",4); 
                            echo "-"; 
                            echo str_repeat("&nbsp;",4); 
                            echo $product['Details']['price'];
                            ?>
                       </h2></p>  
                       <h4><p><?php
                            //$dif = 計算式の答え(会員の残金)  会員の資金 - 製品の値段
                            $dif = $current_user['money'] - $product['Details']['price'];
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
                     <div class="modal-footer">
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


