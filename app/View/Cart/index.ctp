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
  $cart_index = 0;
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
             <div class="p" style="width:100%">
               <?php 
                echo $cart_data['Details']['name'];  
                echo str_repeat("&nbsp;",4);  
               ?>
               <!-- checkbox -->
               <input type="checkbox" name="check" value="1" >
             </div>
             <hr>
             
             <div class="p" style=""><?php echo $cart_data['Details']['content']; ?></div>
             <div class="p" style="color:blue;">$<?php echo $cart_data['Details']['price']; ?></div>
             <div class="p" style="">Condition:<br><?php echo $cart_data['Details']['comment']; ?></div>
             <br>
             
             <form class="" action="" method="post">
               
               <!-- <input type="option" name="count" style="width:100px;" class="p" placeholder="count" value="1"></input> -->
               <!-- <select class="" name="count" type="submit" style="width:50px;">
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
               </select> -->
               
               <!-- botton dropdown -->
               <div class="dropdown">
                <button type="button" name="count" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  quantity
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                  <button class="dropdown-item" type="submit" name="count" value="1" >1</a>
                  <button class="dropdown-item" type="submit" name="count" value="2" >2</a>
                  <button class="dropdown-item" type="submit" name="count" value="3" >3</a>
                  <button class="dropdown-item" type="submit" name="count" value="4" >4</a>
                  <button class="dropdown-item" type="submit" name="count" value="5" >5</a>
                  <button class="dropdown-item" type="submit" name="count" value="6" >6</a>
                  <button class="dropdown-item" type="submit" name="count" value="7" >7</a>
                  <button class="dropdown-item" type="submit" name="count" value="8" >8</a>
                  <button class="dropdown-item" type="submit" name="count" value="9" >9</a>
                  <button class="dropdown-item" type="submit" name="count" value="10" >10</a>
                </div>
              
               
               
               
               <!-- button Buy  押すとモーダルが出る-->
               <button type="button" name="buy" style="" class="btn_buy_item" value="buy">Buy now</button>
               <!-- モーダルの設定 -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <!-- modal title -->
                       <h5 class="modal-title" id="exampleModalLabel"><?php echo $cart_data['Details']['name']; ?></h5>
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
                            echo $cart_data['Details']['price'];
                            ?>
                       </h2></p>  
                       <h4><p><?php
                            //$dif = 計算式の答え(会員の残金)  会員の資金 - 製品の値段
                            $dif = $current_user['money'] - $cart_data['Details']['price'];
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
                         <button type="submit" class="btn btn-disabled" name="buy" value="buy" disabled>Buy</button>
                       <?php } else  { ?>  
                        <button type="submit" class="btn btn-primary" name="buy" value="buy" >Buy</button>
                       <?php  } ?>
                       <!----------------------------------------------------------->
                       
                     </div><!-- /.modal-footer -->
                   </div><!-- /.modal-content -->
                 </div><!-- /.modal-dialog -->
               </div><!-- /.modal -->
               
               <button type="submit" name="delete" style="" class="p" value="delete">Delete</button>
               <!-- ↓のやり方で値を隠せる -->
               <input type="hidden" name="user_money" value="<?php echo $dif ?>">
               <input type="hidden" name="detail_id" value="<?php echo $cart_data['Cartitems']['id'] ?>">
               <input type="hidden" name="cart_id" value="<?php echo $cart_data['Cart']['id'] ?>">
               <input type="hidden" name="product_id" value="<?php echo $cart_data['Details']['id'] ?>">
               </div>
             </form>

           </div>
         </div>
       </div>
     </div>
   </div>
  </div>
  <?php
  $cart_index++;
    }
   ?>
<script type="text/javascript">
  // - please wait until the page has loaded before doing the code inside this block
  $(document).ready(function(){
    $(".btn_buy_item").on("click", function(){
      
      // - last step
      // - manually show modal!!!!
      // - https://getbootstrap.com/docs/4.0/components/modal/
      $('#exampleModal').modal("show");
    });
  });
</script>

 <!-- </form> -->