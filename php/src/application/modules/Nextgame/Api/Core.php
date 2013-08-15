<?php

class Nextgame_Api_Core extends Core_Api_Abstract {
  
  public function getNg() {
    $table = Engine_Api::_()->getDbTable('settings', 'core');
    $settings = $table->fetchAll(
      $table->select()
        ->where('`name` like ?', 'nextgame.%')
    );
    
    $ng = null;
    if ($settings) {
      $siteId = null;
      $secretKey = null;
      
      foreach($settings as $s) {
        switch ($s->name) {
          case 'nextgame.site_id':
            $siteId = $s->value;
            break;
          case 'nextgame.secret_key':
            $secretKey = $s->value;
            break;
        }
      }
      
      if ($siteId && $secretKey) {
        require_once 'application/modules/Nextgame/libraries/NG.php';
        $ng = new NG($siteId, $secretKey);
      }
    }
    
    return $ng;
  }
  
}
