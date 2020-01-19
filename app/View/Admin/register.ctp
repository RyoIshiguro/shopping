<?php 

 ?>
 <!-- app/View/shopping/admin/register.ctp -->
  <div class="loophole form">
  <?php echo $this->Form->create(); ?>
  <!-- <fieldset> </fieldset>で囲んだものは入力コントロールをまとめられる-->
    <fieldset>
      <!-- legend で囲んだものは見出しがつく -->
        <legend><?php echo __('Register User'); ?></legend>
        <?php
          //inputフィールド
          echo $this->Form->input('first_name');
          echo $this->Form->input('last_name');
          echo $this->Form->input('username');
          echo $this->Form->input('email');
          echo $this->Form->input('password');
          //optionリストの設定
          echo $this->Form->input('user_type', array(
            'options' => array('admin' => 'Admin', 'author' => 'Normal User')
            )
          );
          //statusのフォームは隠す。そしてデフォルトで1を与えておく
          echo $this->Form->input('status', array(
            'type' => 'hidden',
            'value' => '1'
            )
          );
          echo $this->Form->input('money');
        ?>
    </fieldset>
  <!-- button  -->
  <?php echo $this->Form->end(__('submit')); ?>
</div>
