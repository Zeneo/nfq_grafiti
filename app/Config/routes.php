<?php

	Router::connect('/', array('controller' => 'index', 'action' => 'index'));
	
	Router::connect('/:controller', array('action' => 'index'));
	Router::connect('/:controller/:action/*');
	//Router::connect('/:language/:controller/:action/*', array(), array('language' => '[a-z]{2}'));
	//Router::connect('/:language/:controller/*', array(), array('language' => '[a-z]{2}'));
	Router::connect('/admin', array('controller' => 'index', 'action' => 'index', 'prefix' => 'admin', 'admin' => true));
	Router::connect("/admin/:controller", array('action' => 'index', 'prefix' => 'admin', 'admin' => true));
	Router::connect("/admin/:controller/:action/*", array('prefix' => 'admin', 'admin' => true));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
