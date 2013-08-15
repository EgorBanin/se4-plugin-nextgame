<div class="layout_page_group_index_browse">

  <div class="generic_layout_container layout_top">
    <div class="generic_layout_container layout_middle">
      <div class="generic_layout_container layout_group_browse_menu">
        <div class="generic_layout_container layout_group_browse_menu">
          <div class="headline">
            <h2>Games and apps</h2>
            <div class="tabs">
              <?php
              
              echo $this->navigation()
                ->menu()
                ->setContainer($this->navigation)
                ->render();
              
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="generic_layout_container layout_main">
    <div class="generic_layout_container layout_middle">
      <div class="generic_layout_container layout_core_content">
        <?php if ($this->app): ?>
          <h2><?php echo htmlspecialchars($this->app->name) ?></h2>
          <div class="nextgame appFrame">
            <div class="app">
              <?php echo $this->ngCode ?>
            </div>
          </div>
        <?php else: ?>
          Not found
        <?php endif ?>
      </div>
    </div>
  </div>

</div>
