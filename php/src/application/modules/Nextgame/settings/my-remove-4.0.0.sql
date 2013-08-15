-- tables
drop table if exists `engine4_nextgame_apps`;
drop table if exists `engine4_nextgame_usersapps`;

-- settings
delete from `engine4_core_settings`
where
  `name` = 'nextgame.site_id'
  or `name` = 'nextgame.secret_key';

-- menus
delete from `engine4_core_menuitems`
where
  `name` = 'core_admin_main_plugins_nextgame'
  or `name` = 'nextgame_admin_main_apps'
  or `name` = 'nextgame_admin_main_settings'
  or `name` = 'core_main_apps'
  or `name` = 'nextgame_main_index'
  or `name` = 'nextgame_main_popular'
  or `name` = 'nextgame_main_my';

delete from `engine4_core_menus`
where
  `name` = 'nextgame_admin_main'
  or `name` = 'nextgame_main';


delete from `engine4_core_modules` where `name` = 'nextgame';
