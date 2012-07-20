<?php
return array(
	'login' => 'users/login',
	'logout' => 'users/logout',
	'memos/(\d+)' => 'memos/index/$1', /* param = current page num. */

	'_root_'  => 'memos',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);