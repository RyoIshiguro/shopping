<style media="screen">
  .p{
    margin-bottom: 5px;
  }
  .container-fluid{
    /* float: left; */
  }
</style>

<?php 
  // foreach ($cart as $carts) {
  //   // code...
  // }
  
  // echo $products;
  // echo '本日の日付は'.$now.'です。';
  
  // echo "<pre>";
  // mulutiple index array   $valuename[array of number][model][feild];
  // var_dump($cart_data['0']['Details']['img']);
  // var_dump($product_data);
 ?>

 <!-- shopping/details/index.ctp -->
 <?php
  foreach ($cart_data as $cart_data) {
  ?>
  <div class="container-fluid" style="float:right;">
   <div class="row" style="height:400px;">
     <div class="card mb-12" style="width: 100%; height:300px;margin:2.5%;">
       <div class="row no-gutters" style="height: 300px;">
         <div class="col-md-4">

              <img class="card-img-top" style="height:300px;" src="http://localhost:8888/shopping/img/<?php echo $cart_data['Details']['img']; ?>" alt="">

         </div>
         <div class="col-md-8">
           <div class="card-body">
             <div class="p" style="width:100%"><?php echo $cart_data['Details']['name']; ?></div>
             <hr>
             <div class="p" style=""><?php echo $cart_data['Details']['content']; ?></div>
             <div class="p" style="color:blue;">$<?php echo $cart_data['Details']['price']; ?></div>
             <div class="p" style="">Condition:<br><?php echo $cart_data['Details']['comment']; ?></div>
             <br>
             
             <form class="" action="" method="post">
               <input type="" name="count" style="width:100px;" class="p" placeholder="count"></input>
               
               <!-- for buy -->
               <button type="button" data-toggle="modal" data-target="#exampleModal" name="buy" style="" class="p" value="buy">Buy now</button>
               <!-- モーダルの設定 -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel"><?php echo $cart_data['Details']['name']; ?></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <h2><p style="color:blue;"><?php 
                            echo $current_user['money'];
                            echo str_repeat("&nbsp;",4); 
                            echo "-"; 
                            echo str_repeat("&nbsp;",4); 
                            echo $cart_data['Details']['price'];
                            ?>
                       </h2></p>  
                       <h4><p><?php
                            $dif = $current_user['money'] - $cart_data['Details']['price'];
                            echo "<br>\n";
                            echo "Remaining balance: $dif";
                            echo str_repeat("&nbsp;",1); 
                            if ($dif < 0) 
                            {
                              echo "not enough money, you have to earn money first.";
                            }
                          ?>
                         <h4></p>
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                       <?php 
                       if ($dif < 0) {
                         ?>
                         <button type="submit" class="btn btn-disabled" name="buy" value="buy" disabled>Buy</button>
                     <?php } else  { ?>  
                        <button type="submit" class="btn btn-primary" name="buy" value="buy" >Buy</button>
                      <?php  } ?>
                     </div><!-- /.modal-footer -->
                   </div><!-- /.modal-content -->
                 </div><!-- /.modal-dialog -->
               </div><!-- /.modal -->
               
               <button type="submit" name="delete" style="" class="p" value="delete">Delete</button>
               <!-- ↓のやり方で値を隠せる -->
               <input type="hidden" name="detail_id" value="<?php echo $cart_data['Cartitems']['id'] ?>">
               <input type="hidden" name="cart_id" value="<?php echo $cart_data['Cart']['id'] ?>">
               <input type="hidden" name="product_id" value="<?php echo $cart_data['Details']['id'] ?>">
               
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

 <!-- </form> -->