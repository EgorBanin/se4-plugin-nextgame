<?php

class Nextgame_AppsController extends Core_Controller_Action_Standard {
  
  public function indexAction() {
    $this->view->navigation = Engine_Api::_()
      ->getApi('menus', 'core')
      ->getNavigation('nextgame_main', array(), 'nextgame_main_index');
    
    
    $this->view->apps = new Zend_Paginator(
      new Zend_Paginator_Adapter_DbSelect(
        Engine_Api::_()->getDbTable('apps', 'nextgame')
          ->select()
          ->where('`enabled` = true')
          ->order('date desc')
      )
    );
    $this->view->apps->setItemCountPerPage(15);
    $this->view->apps->setCurrentPageNumber($this->_request->getParam('page'));
  }
  
  public function popularAction() {
    $this->view->navigation = Engine_Api::_()
      ->getApi('menus', 'core')
      ->getNavigation('nextgame_main', array(), 'nextgame_main_popular');
    
    $table = Engine_Api::_()->getDbTable('apps', 'nextgame');
    $this->view->apps = $table->fetchAll(
      $table->select()
        ->where('`enabled` = true')
        ->order('players desc')
        ->limit(15)
      );
  }
  
}
