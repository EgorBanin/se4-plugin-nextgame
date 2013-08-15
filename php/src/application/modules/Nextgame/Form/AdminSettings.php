<?php


class Nextgame_Form_AdminSettings extends Engine_Form {
  
  public function init() {
    $this->setTitle('Nextgame settings');
    $this->setDescription('Please enter your NG-account settings.');
    
    $this->addElement(
      'text',
      'site_id',
      array(
        'label' => 'Site ID',
        'description' => '',
        'required' => true,
        'filters' => array('StringTrim')
      )
    );
    
    $this->addElement(
      'text',
      'secret_key',
      array(
        'label' => 'Secret key',
        'description' => '',
        'required' => true,
        'filters' => array('StringTrim')
      )
    );
    
    $this->addElement(
      'button',
      'submit',
      array(
        'type' => 'submit',
        'decorators' => array('ViewHelper'),
        'label' => 'Save changes',
        'ignore' => true
      )
    );
  }
  
}
