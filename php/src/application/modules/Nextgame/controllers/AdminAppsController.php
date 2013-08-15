<?php

class Nextgame_AdminAppsController extends Core_Controller_Action_Admin {
  
  private function updateApps() {
    $api = Engine_Api::_()->getApi('core', 'nextgame');
    $ng = $api->getNg();
    
    if ( ! $ng) {
      return $this->_helper->redirector->gotoRoute(array(
        'module' => 'nextgame',
        'controller' => 'settings'
      ), 'admin_default');
    }
    
    try {
      $ngApps = $ng->getApps();
    } catch(Exception $e) {
      return;
    }
    
    $apps = array();
    foreach ($ngApps as $ngApp) {
      $apps[] = array(
        'id' => $ngApp->getId(),
        'name' => $ngApp->getName(),
        'description' => $ngApp->getDescription(),
        'icon' => $ngApp->getIcon(\NG\App::ICON_SIZE_MEDIUM)
      );
    }
    
    if ($apps) {
      Engine_Api::_()->getDbTable('apps', 'nextgame')->updateApps($apps);
    }
  }
  
  public function indexAction() {
    $this->updateApps();
    
    $this->view->navigation = Engine_Api::_()
      ->getApi('menus', 'core')
      ->getNavigation('nextgame_admin_main', array(), 'nextgame_admin_main_apps');
    
    $this->view->apps = new Zend_Paginator(
      new Zend_Paginator_Adapter_DbSelect(Engine_Api::_()->getDbTable('apps', 'nextgame')->select())
    );
    $this->view->apps->setItemCountPerPage(15);
    $this->view->apps->setCurrentPageNumber($this->_request->getParam('page'));
  }
  
  public function installAction() {
    $this->view->result = 'fail';
    $appId = $this->_request->getParam('app');
    if ($appId) {
      $table = Engine_Api::_()->getDbTable('apps', 'nextgame');
      $where = $table->getAdapter()->quoteInto('id = ?', $appId);
      if ($table->update(array('enabled' => true), $where)) {
        $this->view->result = 'success';
      }
    }
  }
  
  public function uninstallAction() {
    $this->view->result = 'fail';
    $appId = $this->_request->getParam('app');
    if ($appId) {
      $table = Engine_Api::_()->getDbTable('apps', 'nextgame');
      $where = $table->getAdapter()->quoteInto('id = ?', $appId);
      if ($table->update(array('enabled' => false), $where)) {
        $this->view->result = 'success';
      }
    }
  }
  
}
