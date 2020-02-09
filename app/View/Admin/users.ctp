  <div><h1>Hello this is users.ctp</h1></div>
  <a href="http://localhost:8888/shopping/admin/register/">Register</a>
  <table class="table table-striped">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">id</th>
      <th scope="col">first_name</th>
      <th scope="col">last_name</th>
      <th scope="col">username</th>
      <th scope="col">email</th>
      <th scope="col">user_type</th>
      <th scope="col">money</th>
      <th scope="col">edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  
  <?php 
   foreach($admin as $admin_users){
   ?>
   
  <tbody class=".table-striped">
    <tr>
      <td><?php echo $admin_users['Admin']['id'];?></td>
      <td><?php echo $admin_users['Admin']['first_name']; ?></td>
      <td><?php echo $admin_users['Admin']['last_name']; ?></td>
      <td><?php echo $admin_users['Admin']['username']; ?></td>
      <td><?php echo $admin_users['Admin']['email']; ?></td>
      <td><?php echo $admin_users['Admin']['user_type']; ?></td>
      <td><?php echo $admin_users['Admin']['money']; ?></td>
      <td>
        <a href="http://localhost:8888/shopping/admin/edit?id=<?php echo $admin_users['Admin']['id']; ?>">Edit</a>
      </td>
      <td>
        <a href="/shopping/admin/delete?id=<?php echo $admin_users['Admin']['id']; ?>">Delete</a>
      </td>
    </tr>
  </tbody>
  
  <?php } ?>
  
  


</table>

<!-- ページングの表示 -->
<div class="" style="">
  <?php echo $this -> Paginator -> numbers(); ?>
</div>
  
<?php 
  // echo "<pre>";
  // var_dump($admin_users);
 ?>