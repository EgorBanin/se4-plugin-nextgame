<div class="tabs">
  <?php
  
  echo $this->navigation()
    ->menu()
    ->setContainer($this->navigation)
    ->render();
  
  ?>
</div>

<script type="text/javascript">
  //<![CDATA[
  
  window.addEvent('domready', function() {
    
    var onClick = function() {
      var el = this;
      el.setStyle('display', 'none');
      
      var request = new Request({
        url: el.href,
        format: 'json'
      });
      request.addEvent('success', function(json) {
        var data = JSON.decode(json);
        if (data.result == 'success') {
          if (el.href.indexOf('uninstall') !== -1) {
            el.href = el.href.split('uninstall').join('install');
            el.set('html', 'install');
          } else {
            el.href = el.href.split('install').join('uninstall');
            el.set('html', 'uninstall');
          }
        } else {
          alert('Error');
        }
        
        el.setStyle('display', 'inline');
      });
      request.send();
      
      return false;
    }
    
    document.getElements('td.actions a').addEvent('click', onClick);
    
  });
  
  //]]>
</script>

<table class="admin_table">
  <thead>
    <tr>
      <th>Actions</th>
      <th>Name</th>
      <th>Description</th>
      <th>Players</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($this->apps as $app): ?>
      <tr>
        <td class="actions">
          <?php if ($app['enabled']): ?>
            <a href="<?php echo $this->url(array('module' => 'nextgame', 'controller' => 'apps', 'action' => 'uninstall', 'app' => $app['id']), 'admin_default') ?>">uninstall</a>
          <?php else: ?>
            <a href="<?php echo $this->url(array('module' => 'nextgame', 'controller' => 'apps', 'action' => 'install', 'app' => $app['id']), 'admin_default') ?>">install</a>
          <?php endif ?>
        </td>
        <td><?php echo htmlspecialchars($app['name']) ?></td>
        <td><?php echo htmlspecialchars($app['description']) ?></td>
        <td><?php echo $app['players'] ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php echo $this->paginationControl($this->apps) ?>
