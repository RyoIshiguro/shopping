admin layout
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hello Lasthomework</title>
    
    
  	<!-- ここにbootstrapを入れる -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  	
  </head>
  
<style media="screen">

  .list-group{
    width:200px;
  }
  
  .list-group-item:hover {
    color: white;
    background-color:blue;
  }
</style>

  <body>
    
    <?php 
  		//これがheader 
  		//Layouts header.ctp をdefaultにした。こうすることで毎回viewでecho $this -> element('header'); を書き込む必要もなくなる
  		//条件文をつけることでheaderの使い分けもできる　admin＝headerA 的な。
  		echo $this -> element('header'); 
  		?>
    
    <div class="container-fluid">
      <div class="row">
        <div class="list-group col-3">
          <a href="http://localhost:8888/shopping/admin/" class="list-group-item list-group-item-action">Home</a>
          <a href="http://localhost:8888/shopping/admin/users/" class="list-group-item list-group-item-action">Users</a>
          <!-- <a href="http://localhost:8888/shopping/admin/register/" class="list-group-item list-group-item-action">Register</a> -->
          <a href="http://localhost:8888/shopping/admin/products/" class="list-group-item list-group-item-action">Products</a>
          <a href="http://localhost:8888/shopping/admin/cart_history/" class="list-group-item list-group-item-action">Cart_history</a>
          <a href="#" class="list-group-item list-group-item-action">Sales</a>
          <a href="#" class="list-group-item list-group-item-action">contact</a>
        </div>
        
        <div class="col offset-3" id="main" style="margin-left:0;">
            <!-- <h1>Main Area</h1> -->
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
      </div>
    </div>
    
    <div id="footer">
			<?php 
				//default cakephp footer
				// 	echo $this->Html->link(
				// 	$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
				// 	'https://cakephp.org/',
				// 	array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				// );
				
				echo $this -> element('footer'); 
				
			?>
			<p>
				<?php 
					// echo $cakeVersion;
				 ?>
			</p>
		</div>
    
  </body>
</html>