<?php 

 ?>
 <!-- app/View/shopping/admin/products_register.ctp -->
  <div class="loophole form">
  
  <!-- 生成する場所(model)をcreate（model)で指定可能 -->
  <?php echo $this->Form->create('Product'); ?>
  <!-- <fieldset> </fieldset>で囲んだものは入力コントロールをまとめられる-->
    <fieldset>
      <!-- legend で囲んだものは見出しがつく -->
        <legend><?php echo __('Register Product'); ?></legend>
        <?php
          //inputフィールド
          echo $this->Form->input('name');
          echo $this->Form->input('content');
          echo $this->Form->input('price');
          echo $this->Form->input('comment');
          echo $this->Form->file('img');
        ?>
    </fieldset>
  <!-- button  -->
  <br>
  <?php echo $this->Form->end(__('Register')); ?>
</div>
