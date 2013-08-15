<?php

class Nextgame_AdminSettingsController extends Core_Controller_Action_Admin {
  
  public function indexAction() {
    $this->view->navigation = Engine_Api::_()
      ->getApi('menus', 'core')
      ->getNavigation('nextgame_admin_main', array(), 'nextgame_admin_main_settings');
    
    $form = new Nextgame_Form_AdminSettings();
    
    if($this->getRequest()->isPost()) {
      if($form->isValid($_POST)) {
        $values = $form->getValues();
        
        $table = Engine_Api::_()->getDbTable('settings', 'core');
        $table->update(
          array('value' => $values['site_id']),
          $table->getAdapter()->quoteInto('name = ?', 'nextgame.site_id')
        );
        $table->update(
          array('value' => $values['secret_key']),
          $table->getAdapter()->quoteInto('name = ?', 'nextgame.secret_key')
        );
        
        $form->addNotice('Your changes have been saved.');
      }
    } else {
      $table = Engine_Api::_()->getDbTable('settings', 'core');
      $settings = $table->fetchAll(
        $table->select()
          ->where('`name` like ?', 'nextgame.%')
      );
      
      if ($settings) {
        foreach($settings as $s) {
          switch ($s->name) {
            case 'nextgame.site_id':
              $form->getElement('site_id')->setValue($s->value);
              break;
            case 'nextgame.secret_key':
              $form->getElement('secret_key')->setValue($s->value);
              break;
          }
        }
      }
    }
    
    $this->view->form = $form;
  }
  
}
