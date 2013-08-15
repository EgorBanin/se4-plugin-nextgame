<div class="tabs">
  <?php
  
  echo $this->navigation()
    ->menu()
    ->setContainer($this->navigation)
    ->render();
  
  ?>
</div>

<div class="settings">
  <?php echo $this->form->render($this) ?>
</div>
