<?php

class Nextgame_Model_DbTable_Apps extends Engine_Db_Table {
  
  protected $_rowClass = 'Nextgame_Model_App';
  
  protected $_sequence = false;
  
  public function updateApps(array $apps) {
    $sql = '
      insert ignore into `'.$this->_name.'` (
        `id`, `name`, `description`, `icon`
      )
      values
    ';
    $firstIteration = true;
    $values = array();
    foreach ($apps as $app) {
      if ($firstIteration) {
        $firstIteration = false;
      } else {
        $sql .= ',';
      }
      $sql .= '(
        ?, ?, ?, ?
      )';
      $values[] = $app['id'];
      $values[] = $app['name'];
      $values[] = $app['description'];
      $values[] = $app['icon'];
    }
    
    $this->_db->query($sql, $values);
  }
  
}
