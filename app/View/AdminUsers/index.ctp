<body>
  <table>
    <tr>
     <th>id</th>
     <th>first_name</th>
     <th>last_name</th>
     <th>user_name</th>
     <th>email</th>
     <th>user_type</th>
     <th>edit</th>
     <th>Delete</th>
   </tr>
   
   <?php 
    foreach($users as $user){
    ?>
    
    <tr>

     <td><?php echo $user['User']['id'];?></td>
     <td><?php echo $user['User']['first_name']; ?></td>
     <td><?php echo $user['User']['last_name']; ?></td>
     <td><?php echo $user['User']['user_name']; ?></td>
     <td><?php echo $user['User']['email']; ?></td>
     <td><?php echo $user['User']['user_type']; ?></td>
     <td>
       <!-- <a href="/cakephp4/employees/edit?id=<?php echo $user['User']['id']; ?>">Edit</a> -->
     </td>
     <td>
       <!-- <a href="/cakephp4/employees/delete?id=<?php echo $user['User']['id']; ?>">Delete</a> -->
     </td>
   </tr>

<?php } ?>
   
  </table>
  
  <!-- ページングの表示 -->
<?php echo $this -> Paginator -> numbers(); ?>
  
  
</body>