<style media="screen">
  .p{
    margin-bottom: 5px;
  }
</style>

<?php 
  // foreach ($cart as $carts) {
  //   // code...
  // }
  
  // echo $products;
  echo '本日の日付は'.$now.'です。';
 ?>
 
 
 <!-- shopping/details/index.ctp -->
 
 <!-- card -->
 <form class="" action="" method="post" enctype="multipart/form-data">
 <?php
  // foreach ($cart as $carts) {
  ?>
  <div class="container-fluid">
   <div class="row" style="height:400px;">
     <div class="card mb-12" style="width: 100%; height:300px;margin:2.5%;">
       <div class="row no-gutters" style="height: 300px;">
         <div class="col-md-4">

              <img class="card-img-top" style="height:300px;" src="http://localhost:8888/shopping/img/<?php echo $product['Details']['img']; ?>" alt="">

         </div>
         <div class="col-md-8">
           <div class="card-body">
             <div class="p" style="width:100%"><?php echo $product['Details']['name']; ?></div>
             <hr>
             <div class="p" style=""><?php echo $product['Details']['content']; ?></div>
             <div class="p" style="color:blue;">$<?php echo $product['Details']['price']; ?></div>
             <div class="p" style="">Condition:<br><?php echo $product['Details']['comment']; ?></div>
             
             <form class="" action="" method="get">
               <input type="" name="count" style="width:100px;" class="p" placeholder="count"></input>
               <button type="submit" name="buy" style="" class="p">Buy now</button>
               <button type="submit" name="delete" style="" class="p">Delete</button>
             </form>
             
           </div>
         </div>
       </div>
     </div>
   </div>
  </div>
  <?php
    // }
   ?>

 </form>