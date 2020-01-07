<?php 
  // echo $this->element('header');
 ?>
 
 <!DOCTYPE html>
 <html lang="ja" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Hello Lasthomework</title>
   </head>
   <body>
     
     <?php 
      // session
      // echo "session :". " ".$username;
      // echo $username;
      
      if(isset($id)){
          echo 'Welcom :'. ' '.$username;
      }
    
     ?>
     
     <div class=".container-fluid">
        <div class="row">
         <?php 
          foreach($product as $products){ 
         ?>
          <div class="col-sm-3">
            <div class="card" style="width: 280px; margin:5px;">
              <img class="card-img-top" style="height:200px;" src="http://localhost:8888/shopping/img/<?php echo $products['Product']['img']; ?>" alt="">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="http://localhost:8888/shopping/details">
                    <?php echo $products['Product']['name']; ?>
                  </a>
                 </h5>
                 <p class="card-text"><?php echo $products['Product']['content']; ?></p>
                 <p class="card-text"><?php echo $products['Product']['price']; ?></p>
                 <p class="card-text"><?php echo $products['Product']['comment']; ?></p>
              </div>
            </div>
          </div>
        <?php
          }
         ?>
      </div>
    </div>
   </body>
 </html>