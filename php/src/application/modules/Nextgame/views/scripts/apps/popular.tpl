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
        <div class="nextgame apps">
          <?php foreach ($this->apps as $app): ?>
            <div class="app">
              <div class="wrapper">
                <a href="<?php echo $this->url(array('module' => 'nextgame', 'controller' => 'user-apps', 'action' => 'play', 'app' => $app['id']), 'default') ?>" class="icon"><img src="<?php echo addslashes($app['icon']) ?>"></a>
                <div class="info">
                  <h3><a href="<?php echo $this->url(array('module' => 'nextgame', 'controller' => 'user-apps', 'action' => 'play', 'app' => $app['id']), 'default') ?>"><?php echo htmlspecialchars($app['name']) ?></a></h3>
                  <div class="description"><?php echo htmlspecialchars($app['description']) ?></div>
                  <div class="players"><?php echo $app['players'] ?> players</div>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>

</div>
