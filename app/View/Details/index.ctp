<?php 
  // echo "<pre>";
  // var_dump($product['Details']['id']);
  // var_dump($product);
 ?>

    
  
  <!-- shopping/details/index.ctp -->
 <form class="" action="" method="post">

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
             
             
             <button type="submit" name="cart" style="">Cart</button>
             <button type="submit" name="buy" style="">Buy now</button>
             
           </div>
         </div>
       </div>
     </div>
   </div>
  </div>

 </form>
