<?php
return [
	'layout_on' => true,
	'layout_name' => 'layout',
	'tpl_replace_string' => [
		'__STATIC__' => STATIC_PATH,
		'__CSS__' => STATIC_PATH . 'css',
		'__JS__' => STATIC_PATH . 'js',
		'__IMG__' => STATIC_PATH . 'images',
		'__LIB__' => STATIC_PATH . 'lib',
		'__ADMINCSS__' => STATIC_PATH . 'admin/css',
		'__ADMINJS__' => STATIC_PATH . 'admin/js',
		'__HOMECSS__' => STATIC_PATH . 'admin/css',
		'__HOMEJS__' => STATIC_PATH . 'admin/js',
	],
];