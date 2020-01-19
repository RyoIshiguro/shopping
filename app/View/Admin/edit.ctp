<style media="screen">
  .p{
    margin: 2px;
  }
</style>

<form class="" action="" method="post">
  <p class="p">first_name : <input type="text" name="first_name" value="<?php echo $admin['Admin']['first_name']; ?>"></p><br>
  <p class="p">last_name : <input type="text" name="last_name" value="<?php echo $admin['Admin']['last_name']; ?>"></p><br>
  <p class="p">username : <input type="text" name="username" value="<?php echo $admin['Admin']['username']; ?>"></p><br>
  <p class="p">email : <input type="text" name="email" value="<?php echo $admin['Admin']['email']; ?>"></p><br>
  <p class="p">user_type : 
    <select name="user_type">
      <option>admin</option>
      <option>Normal User</option>
    </select></p><br>
  <p class="p">money : <input type="text" name="money" value="<?php echo $admin['Admin']['money']; ?>"></p><br>
    
  
    <?php 
    // echo $this->Form->input('user_type :', array(
    //   'options' => array(
    //     'admin' => 'Admin', 
    //     'author' => 'Normal User'
    //     )
    //   )
    // );
  ?>
  <button type="submit" class="p" name="button">Update</button>
</form>