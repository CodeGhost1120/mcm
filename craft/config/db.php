<?php

/**
 * Database Configuration
 *
 * All of your system's database configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/db.php
 */

return array(
  '*' => array(
    'tablePrefix' => 'craft_',
  ),

  '.dev' => array(
    'server' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'database' => 'mcm',
  ),


    'mcm.local' => array(
        'server' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'database' => 'mcm',
    ),

 'mcm.nclud.com' => array(
  'server' => 'db6.browsermedia.com',
  'user' => 'mcm_staging',
  'password' => '2cOvtHkL',
  'database' => 'mcm_staging',
  ),

 'mcmstag.nclud.com' => array(
  'server' => 'db6.browsermedia.com',
  'user' => 'mcmstag',
  'password' => 'TzqVfKj7',
  'database' => 'mcmstag',
  ),

  'marinemarathon.com' => array(
  	'server' => 'madine.browsermedia.com',
  	'user' => 'mcm',
  	'password' => 'VIMGMJQ4',
  	'database' => 'mcm',
  ),

 'admin.marinemarathon.com' => array(
  	'server' => 'madine.browsermedia.com',
  	'user' => 'mcm',
  	'password' => 'VIMGMJQ4',
  	'database' => 'mcm',
  ),

);
