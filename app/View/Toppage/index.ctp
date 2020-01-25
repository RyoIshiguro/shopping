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
              <img class="card-img-top" style="height:200px; border-color:black;" src="http://localhost:8888/shopping/img/<?php echo $products['Product']['img']; ?>" alt="">
              <div class="card-body">
                <h5 class="card-title">
                  <form class="" action="http://localhost:8888/shopping/details" method="get">
                    <a href="http://localhost:8888/shopping/details?id=<?php echo $products['Product']['id']; ?>">
                      <?php echo $products['Product']['name']; ?>
                    </a>
                  </form>
                 </h5>
                 <p class="card-text"><?php echo $products['Product']['content']; ?></p>
                 <p class="card-text">$<?php echo $products['Product']['price']; ?></p>
                 <p class="card-text">condition:<br><?php echo $products['Product']['comment']; ?></p>
                 <!-- <p class="card-text"><?php echo $products['Product']['id']; ?></p> -->
              </div>
            </div>
          </div>
        <?php
          }
         ?>
      </div>
    </div>
    
    <!-- ページングの表示 -->
    <?php echo $this -> Paginator -> numbers(); ?>
   </body>
 </html>