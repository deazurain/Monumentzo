<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'default' => array(
		'type'       => 'mysql',
        'connection' => array(
            'hostname'   => 'localhost',
            'username'   => 'root',
            'password'   => 'M0NUM3NTz0',
            'persistent' => FALSE,
            'database'   => 'Monumentzo',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => TRUE,
	),
);