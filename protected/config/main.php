<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'language' => 'zh_cn',//语言包

	// preloading 'log' component
	'preload'=>array('log'),

	'timeZone' => 'Asia/Shanghai',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//SRBAC权限管理     
		'application.modules.srbac.controllers.SBaseController',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
		//权限模块
		'srbac' => array(
			'userclass'=>'user', //可选,默认是 User 对应用户的model
			'userid'=>'userid', //可选,默认是 userid 用户表标识位对应字段
			'username'=>'username', //可选，默认是 username 用户表中用户名对应字段
			'delimeter'=>'@', //item分隔符 默认是:-
			'debug'=>true, //可选,默认是 false	  调试模式，true则所有用户均开放，可以随意修改权限控制
			'pageSize'=>10, //可选，默认是 15
			'superUser' =>'Authority', //超级管理员，这个账号可以不受权限控制的管理，对所有页面均有访问权限 可选，默认是 Authorizer
			'css'=>'srbac.css',  //可选，默认是 srbac.css
			'layout'=>'application.views.layouts.main', //可选,默认是 application.views.layouts.main,
						//必须是一个存在的路径别名
			'notAuthorizedView'=> 'srbac.views.authitem.unauthorized', // 可选,默认是unauthorized.php
			//srbac.views.authitem.unauthorized, 必须是一个存在的路径别名
			'alwaysAllowed'=>array( //可选,默认是 array()   总是允许访问的动作
				'SiteLogin','SiteLogout','SiteIndex', 
				'SiteError', 'SiteContact'
			),
			'userActions'=>array('Show','View','List'), //可选,默认是空数组 array() 
			'listBoxNumberOfLines' => 15, //可选,默认是10
	        'imagesPath' => 'srbac.images', //可选,默认是 srbac.images
	        'imagesPack'=>'noia', //可选,默认是 noia
	        'iconText'=>true, //可选,默认是 false
	        'header'=>'srbac.views.authitem.header', //可选,默认是
	        // srbac.views.authitem.header, 必须是一个存在的路径别名
	        'footer'=>'srbac.views.authitem.footer', //可选,默认是
	        // srbac.views.authitem.footer, 必须是一个存在的路径别名
	        'showHeader'=>true, //可选,默认是false
	        'showFooter'=>true, //可选,默认是false
	        'alwaysAllowedPath'=>'srbac.components', //可选,默认是 srbac.components
	        // 必须是一个存在的路径别名
	    ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=srbac',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'authManager'=>array(
		        // 类SDbAuthManager在srbac模块中的路径（别名），注意大小写
		        'class'=>'application.modules.srbac.components.SDbAuthManager',
		        // 使用的数据库的组件名        
		        'connectionID'=>'db',
		        // 下面是3个数据表，后面再说每个表的作用
		        // The itemTable name (default:authitem) 授权项表
		        'itemTable'=>'items',         
		        // The assignmentTable name (default:authassignment)  权限分配表         
		        'assignmentTable'=>'assignments',         
		        // The itemChildTable name (default:authitemchild)   任务对应权限表      
		        'itemChildTable'=>'itemchildren',       
		), 

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);