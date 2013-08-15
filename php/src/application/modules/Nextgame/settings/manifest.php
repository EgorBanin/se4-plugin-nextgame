<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'nextgame',
    'version' => '4.0.0',
    'path' => 'application/modules/Nextgame',
    'title' => 'NextGame',
    'description' => 'Games and applications.',
    'author' => 'Egor Banin',
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Module',
    ),
    'actions' => 
    array (
      'install',
      'upgrade',
      'refresh',
      'remove'
    ),
    'directories' => 
    array (
      0 => 'application/modules/Nextgame',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/nextgame.csv',
    ),
  ),
  'items' => array(
    'nextgame_app'
  )
); ?>
