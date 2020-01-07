<style media="screen">
  .p{
    margin: 2px;
  }
</style>

<?php 
  //echo "<pre>";
  // var_dump($products); 
?>

<form class="" action="" method="post">
  <p class="p">name : <input type="text" name="name" value="<?php echo $products['Product']['name']; ?>"></p><br>
  <p class="p">content : <input type="text" name="content" value="<?php echo $products['Product']['content']; ?>"></p><br>
  <p class="p">price : <input type="text" name="price" value="<?php echo $products['Product']['price']; ?>"></p><br>
  <p class="p">comment : </p><textarea type="text" name="comment" value=""><?php echo $products['Product']['comment']; ?></textarea><br>
  <p class="p">image : </p><input type="file" name="img" value=""><?php echo $products['Product']['img']; ?><br>
  <button type="submit" class="p" name="button">Update</button>
</form>