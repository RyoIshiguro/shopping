<?php
  // namespace App\Controller\Component;
  // 
  // use Cake\Controller\Component;
   
  class DateComponent extends Component
  {
      public function today()
      {
          return date('Y/m/d H:i:s');
      }
  }
?>