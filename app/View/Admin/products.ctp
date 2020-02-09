<div><h1>Hello this is Products.ctp</h1></div>
<a href="http://localhost:8888/shopping/admin/products_register/">Register</a>
<table class="table table-striped">
<thead>
  <tr>
    <!-- <th scope="col">#</th> -->
    <th scope="col">id</th>
    <th scope="col">name</th>
    <th scope="col">content</th>
    <th scope="col">price</th>
    <th scope="col">comment</th>
    <th scope="col">img</th>
    <th scope="col">edit</th>
    <th scope="col">Delete</th>
  </tr>
</thead>

<?php 
 foreach($product as $products){
 ?>
 
<tbody class=".table-striped">
  <tr>
    <td><?php echo $products['Product']['id'];?></td>
    <td><?php echo $products['Product']['name']; ?></td>
    <td><?php echo $products['Product']['content']; ?></td>
    <td><?php echo $products['Product']['price']; ?></td>
    <td><?php echo $products['Product']['comment']; ?></td>
    <td><?php echo $products['Product']['img']; ?></td>
    <td>
      <a href="http://localhost:8888/shopping/admin/products_edit?id=<?php echo $products['Product']['id']; ?>">Edit</a>
    </td>
    <td>
      <a href="/shopping/admin/produect_delete?id=<?php echo $products['Product']['id']; ?>">Delete</a>
    </td>
  </tr>
</tbody>

<?php } ?>



</table>

<!-- ページングの表示 -->
<div class="">
  <?php echo $this -> Paginator -> numbers(); ?>
</div>


<?php 
// echo "<pre>";
// var_dump($admin_users);
?>