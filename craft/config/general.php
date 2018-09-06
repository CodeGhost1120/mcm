<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/general.php
 */

define('BASEPATH', realpath(CRAFT_BASE_PATH . '/../') . '/');

return array(

	'*' => array(
		'omitScriptNameInUrls' => true,
		'useEmailAsUsername' => true,
		'allowAutoUpdates' => true,
		'loginPath' => 'admin/login',
		'appId' => 'V966x74U2n4bL9Uvtj93',
		'pageTrigger' => 'page/',
	),

	'mcm.craft.dev' => array(
		'devMode' => true,
		'siteUrl' => 'http://mcm.craft.dev',
		'siteName' => 'Marine Marathon - Local',
		'environmentVariables' => array(
        'baseUrl'  => 'http://mcm.craft.dev/',
        'basePath' => BASEPATH . 'http/',
    ),
	),

	'mcm.nclud.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://mcm.nclud.com',
		'siteName' => 'Marine Marathon - Staging',
		'cacheMethod' => 'redis'			  
	),

	'marinemarathon.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://www.marinemarathon.com',
		'siteName' => 'Marine Marathon',
		'cacheMethod' => 'redis',
		'overridePhpSessionLocation' => false
	),
     	'mcm1.browsermedia.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://mcm1.browsermedia.com',
		'siteName' => 'Marine Marathon',
		'cacheMethod' => 'redis'			  
	),

     	'mcm2.browsermedia.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://mcm2.browsermedia.com',
		'siteName' => 'Marine Marathon',
		'cacheMethod' => 'redis'			  
	),

     	'mcm3.browsermedia.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://mcm3.browsermedia.com',
		'siteName' => 'Marine Marathon',
		'cacheMethod' => 'redis'			  
	),

     	'mcm4.browsermedia.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://mcm4.browsermedia.com',
		'siteName' => 'Marine Marathon',
		'cacheMethod' => 'redis'			  
	),

     	'mcm5.browsermedia.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://mcm5.browsermedia.com',
		'siteName' => 'Marine Marathon',
		'cacheMethod' => 'redis'			  
	),
	     
     	'mcmlb.browsermedia.com' => array(
		'allowAutoUpdates' => false,
		'devMode' => false,
		'siteUrl' => 'http://mcmlb.browsermedia.com',
		'siteName' => 'Marine Marathon',
		'cacheMethod' => 'redis'			  
	),

	     

);
