INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES  ('nextgame', 'NextGame', 'Games and applications.', '4.0.0', 1, 'extra') ;

-- tables
drop table if exists `engine4_nextgame_apps`;
create table `engine4_nextgame_apps` (
  `id` int unsigned not null,
  `enabled` bool not null default false,
  `name` varchar(255) not null,
  `description` varchar(1000) not null,
  `icon` varchar(255) not null,
  `screenshots` varchar(1000) not null default '' comment 'JSON-encoded array',
  `players` int unsigned not null default 0,
  `date` timestamp not null default current_timestamp,
  primary key (`id`),
  key `enabled_players` (`enabled`, `players`),
  key `enabled_date` (`enabled`, `date`)
)
engine InnoDB
default character set = 'utf8'
default collate = 'utf8_general_ci'
comment 'Games and applications';

drop table if exists `engine4_nextgame_usersapps`;
create table `engine4_nextgame_usersapps` (
  `user_id` int unsigned not null,
  `app_id` int unsigned not null,
  `last_access` timestamp not null default current_timestamp,
  primary key (`app_id`, `user_id`),
  key `last_access` (`last_access`)
)
engine InnoDB
comment 'Users applications';

-- settings
insert ignore into `engine4_core_settings`
  (`name`, `value`)
values
  ('nextgame.site_id', ''),
  ('nextgame.secret_key', '');

-- admin menu
insert ignore into `engine4_core_menuitems`
set
  `name` = 'core_admin_main_plugins_nextgame',
  `module` = 'nextgame',
  `label` = 'NextGame',
  `plugin` = '',
  `params` = '{"route":"admin_default","module":"nextgame","controller":"apps","action":"index"}',
  `menu` = 'core_admin_main_plugins',
  `submenu` = '',
  `enabled` = true,
  `custom` = false,
  `order` = 999;

insert ignore into `engine4_core_menus`
set
  `name` = 'nextgame_admin_main',
  `type` = 'standard',
  `title` = 'Games and Apps',
  `order` = 999;

insert ignore into `engine4_core_menuitems`
set
  `name` = 'nextgame_admin_main_apps',
  `module` = 'nextgame',
  `label` = 'Games',
  `plugin` = '',
  `params` = '{"route":"admin_default","module":"nextgame","controller":"apps","action":"index"}',
  `menu` = 'nextgame_admin_main',
  `submenu` = '',
  `enabled` = true,
  `custom` = false,
  `order` = 1;
  
insert ignore into `engine4_core_menuitems`
set
  `name` = 'nextgame_admin_main_settings',
  `module` = 'nextgame',
  `label` = 'Settings',
  `plugin` = '',
  `params` = '{"route":"admin_default","module":"nextgame","controller":"settings","action":"index"}',
  `menu` = 'nextgame_admin_main',
  `submenu` = '',
  `enabled` = true,
  `custom` = false,
  `order` = 1;

-- main menu
insert ignore into `engine4_core_menuitems`
set
  `name` = 'core_main_apps',
  `module` = 'nextgame',
  `label` = 'Games',
  `plugin` = '',
  `params` = '{"route":"default","module":"nextgame","controller":"apps","action":"index"}',
  `menu` = 'core_main',
  `submenu` = '',
  `enabled` = true,
  `custom` = false,
  `order` = 999;

insert ignore into `engine4_core_menus`
set
  `name` = 'nextgame_main',
  `type` = 'standard',
  `title` = 'Games and Apps',
  `order` = 999;

insert ignore into `engine4_core_menuitems`
set
  `name` = 'nextgame_main_index',
  `module` = 'nextgame',
  `label` = 'All games',
  `plugin` = '',
  `params` = '{"route":"default","module":"nextgame","controller":"apps","action":"index"}',
  `menu` = 'nextgame_main',
  `submenu` = '',
  `enabled` = true,
  `custom` = false,
  `order` = 1;

insert ignore into `engine4_core_menuitems`
set
  `name` = 'nextgame_main_popular',
  `module` = 'nextgame',
  `label` = 'Popular games',
  `plugin` = '',
  `params` = '{"route":"default","module":"nextgame","controller":"apps","action":"popular"}',
  `menu` = 'nextgame_main',
  `submenu` = '',
  `enabled` = true,
  `custom` = false,
  `order` = 2;

insert ignore into `engine4_core_menuitems`
set
  `name` = 'nextgame_main_my',
  `module` = 'nextgame',
  `label` = 'My games',
  `plugin` = '',
  `params` = '{"route":"default","module":"nextgame","controller":"user-apps","action":"index"}',
  `menu` = 'nextgame_main',
  `submenu` = '',
  `enabled` = true,
  `custom` = false,
  `order` = 3;
