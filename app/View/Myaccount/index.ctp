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

          <img class="card-img-top" style="height:100%;" src="http://localhost:8888/shopping/img/ギルドマーク.jpg" alt="カードマーク">

         </div>
         <div class="col-md-8">
           <div class="card-body">
             <div class="" style="width:100%">
               <h2>
                 <?php 
                  echo "HERO NAME  : ".str_repeat("&nbsp;",4).$current_user['username']; 
                  ?>
                </h2>
              </div>
             <hr>
             <br>
             <div class="" style="">
               <h3>
                 <?php 
                  echo "Email  : ".str_repeat("&nbsp;",4).$current_user['email']; 
                  ?>
                </h3>
              </div>
              <br>
             <div class="" style="color:blue;">
               <h3>
                 <?php 
                  echo "Money  : ".str_repeat("&nbsp;",4).$current_user['money']; 
                  ?>
                </h3>
              </div>
              <br>
             <div class="" style="">
               <h4>
                 <?php 
                  // echo "Password  : ".str_repeat("&nbsp;",4).$current_user['password']; 
                  ?>
                </h4>
              </div>
              <br>
             
             <form class="" action="" method="post">
               <button type="submit" name="edit_user_data"><a href="http://localhost:8888/shopping/myaccount/user_information_edit">Edit HERO information</a></button>
            </form>
           </div>
         </div>
       </div>
     </div>
   </div>
  </div>


