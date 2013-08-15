<?php

class Nextgame_UserAppsController extends Core_Controller_Action_User {
  
  private $_viewer;
  
  public function init() {
    $this->_viewer = $this->_helper->api()->user()->getViewer();
  }
  
  public function indexAction() {
    $this->view->navigation = Engine_Api::_()
      ->getApi('menus', 'core')
      ->getNavigation('nextgame_main', array(), 'nextgame_main_my');
    
    $this->view->apps = new Zend_Paginator(
      new Zend_Paginator_Adapter_DbSelect(
        Engine_Api::_()->getDbTable('usersApps', 'nextgame')
          ->select()
          ->setIntegrityCheck(false)
          ->from('engine4_nextgame_usersapps')
          ->where('`user_id` = ?', $this->_viewer->user_id)
          ->join('engine4_nextgame_apps', '`engine4_nextgame_apps`.`id` = `engine4_nextgame_usersapps`.`app_id`')
          ->order('last_access', 'desc')
      )
    );
    $this->view->apps->setItemCountPerPage(15);
    $this->view->apps->setCurrentPageNumber($this->_request->getParam('page'));
  }
  
  public function playAction() {
    $this->view->navigation = Engine_Api::_()
      ->getApi('menus', 'core')
      ->getNavigation('nextgame_main', array(), 'nextgame_main_my');
    
    $appsTable = Engine_Api::_()->getDbTable('apps', 'nextgame');
    $appId = $this->_request->getParam('app');
    $app = $appsTable->find($appId)->current();
    if ($app) {
      $this->view->app = $app;
      
      if (Engine_Api::_()->getDbTable('usersApps', 'nextgame')->install($this->_viewer->user_id, $app->id)) {
        $appsTable->update(
          array('players' => new Zend_Db_Expr('`players` + 1')),
          $appsTable->getAdapter()->quoteInto('`id` = ?', $app->id)
        );
      }
      
      $api = Engine_Api::_()->getApi('core', 'nextgame');
      $ng = $api->getNg();
      
      if ($ng) {
        $ngUser = $ng->user($this->_viewer->user_id, $this->_viewer->displayname);
        
        $fields = Engine_Api::_()->fields()->getFieldsValuesByAlias($this->_viewer);
        if (isset($fields['gender'])) {
          $ngUser->setSex(($fields['gender'] == 1)? 'F' : 'M');
        }
        
        if (isset($fields['birthdate'])) {
          try {
            $date = new DateTime($fields['birthdate']);
            $ngUser->setBirthday($date);
          } catch(Exception $e) {
            // skip
          }
        }
        
        $avatar = $this->_viewer->getPhotoUrl();
        if ($avatar) {
          $ngUser->setAvatar($this->view->ServerUrl($avatar));
          $ngUser->setPhoto($this->view->ServerUrl($avatar));
        }
        
        $this->view->ngCode = $ng->code()->setUser($ngUser)->setAppId($app->id);
      } else {
        $this->getResponse()->setHttpResponseCode(500);
      }
    } else {
      $this->getResponse()->setHttpResponseCode(404);
    }
  }
  
  public function removeAction() {
    $appId = $this->_request->getParam('app');
    
    $table = Engine_Api::_()->getDbTable('usersApps', 'nextgame');
    $result = $table->delete(array(
      $table->getAdapter()->quoteInto('`user_id` = ?', $this->_viewer->user_id),
      $table->getAdapter()->quoteInto('`app_id` = ?', $appId),
    ));
    
    if ($result) {
      $appsTable = Engine_Api::_()->getDbTable('apps', 'nextgame');
      $appsTable->update(
        array('players' => new Zend_Db_Expr('`players` - 1')),
        $appsTable->getAdapter()->quoteInto('`id` = ?', $appId)
      );
    }
    
    return $this->_helper->redirector('index');
  }
  
}
