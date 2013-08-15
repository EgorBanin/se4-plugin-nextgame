<?php

class Nextgame_Model_DbTable_UsersApps extends Engine_Db_Table {
  
  protected $_sequence = false;
  
  public function install($userId, $appId) {
    $select = $this->select()
      ->where('user_id = ?', $userId)
      ->where('app_id = ?', $appId);
    $row = $this->fetchRow($select);
    
    $sql = '
      insert into `'.$this->_name.'`
      set
        `user_id` = ?,
        `app_id` = ?,
        `last_access` = now()
      on duplicate key update
        `last_access` = values(`last_access`);
    ';
    $this->_db->query($sql, array($userId, $appId));
    
    return ! $row;
  }
  
}
