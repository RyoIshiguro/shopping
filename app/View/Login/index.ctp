<?php 
  // var_dump($email);  
  // var_dump($psw);
  // var_dump($user);
  
  //session
  // echo "session :". " ".$username;
  // var_dump($id);
 ?>
<!-- view Login.ctp -->
<div class="Login form">
<!-- $this->Flash->render();フラッシュメッセージの設定 -->
<?php echo $this->Flash->render('auth'); ?>

<?php echo $this->Form->create('Login'); ?>
    <fieldset>

        <legend>
            <?php echo __('Please enter your username and password'); ?>
            
        </legend>
        <br>
        <?php
          echo $this->Form->input('username');echo "<br>\n";
          echo $this->Form->input('password');echo "<br>\n";
        ?>
        <label>
          <?php echo $this->Form->checkbox('rememberMe',array('hiddenField' => false)); ?>
          <?php echo 'rememberMe'; ?>
        </label>


    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div><br>
<?php echo $this->Html->link(
   'Registration',array(
     'controller' => 'register',
     'action' => 'index')
   );
 ?>