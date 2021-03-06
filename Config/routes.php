<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
//App::uses('Page', 'Model');
App::import('Model', 'Page');
$Page = new Page();


$cmsPages = $Page->find('all',array('group'=>'Page.url_key','conditions'=>array('NOT'=>array('Page.url_key'=>array('prenotazioni')))));
//echo '<pre>';print_r($cmsPages); die;
if ($cmsPages) {
    foreach ($cmsPages as $key => $value) {

        if ($value['Page']['url_key'] != '/') {
            Router::connect('/' . $value['Page']['url_key'], array('controller' => 'pages', 'action' => 'view', $value['Page']['url_key']));
        }
    }
}


	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
       //Router::connect('/cms/:url_key', array('controller' => 'pages','action'=>'view'),array('pass'=>array('url_key')));
       Router::connect('/search/*', array('controller' => 'properties','action'=>'search'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
