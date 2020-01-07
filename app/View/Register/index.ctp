<?php 
  // var_dump($firstname);
  echo $this->element('sql_dump');
 ?>
<!-- app/View/shopping/register/index.ctp -->
  <div class="register form">
  <?php echo $this->Form->create(); ?>
  <!-- <fieldset> </fieldset>で囲んだものは入力コントロールをまとめられる-->
    <fieldset>
      <!-- legend で囲んだものは見出しがつく -->
        <legend><?php echo __('Add User'); ?></legend>
        <?php
          //inputフィールド
          echo $this->Form->input('first_name');
          echo $this->Form->input('last_name');
          echo $this->Form->input('username');
          echo $this->Form->input('email');
          echo $this->Form->input('password');
          
          //statusがセットされていて中身がadminなら
          if(isset($status) && $status == 'admin')
          {
            //optionリストの設定 user_typeはadminかuserか
            echo $this->Form->input('user_type', array(
              'options' => array('admin' => 'Normal User', 'author' => 'Admin')
              )
            );
          }
          else
          {
            //
            echo $this->Form->input('user_type', array(
              'type' => 'hidden',
              'value' => 'Normal User'
              )
            );
          }
          //statusのフォームは隠す。そしてデフォルトで1を与えておく
          echo $this->Form->input('status', array(
            'type' => 'hidden',
            'value' => '1'
            )
          );
        ?>
    </fieldset>
  <!-- button  -->
  <?php echo $this->Form->end(__('submit')); ?>
</div>
