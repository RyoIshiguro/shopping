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
               <button type="submit" name="buy" style="" class="p" value="buy">Buy now</button>
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