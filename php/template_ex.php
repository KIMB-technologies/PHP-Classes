<?php
/** 
 * KIMB-technologies
 * https://github.com/KIMB-technologies/
 * 
 * (c) 2019 KIMB-technologies 
 * 
 * released under the terms of MIT License
 * https://opensource.org/licenses/MIT
 */

/**
 * Example load.
 */
define('KIMB-Classes', 'ok');
require_once( __DIR__ . '/classes/autoload.php' );

/**
 * Example Template
 */

// set default URL
Template::setServerURL( 'http://localhost:8080/' );
// create default template
$t = new Template('main');
//	set values for placholder
$t->setContent( 'MOREHEADER', '<!-- MoreHeader -->' );
$t->setContent( 'TITLE', 'My Site' );
// ceate a template to include	
$it = new Template('inner');
$t->includeTemplate($it);
// add a multiple content
$it->setMultipleContent('LIST', array(
	array('%%NAME%%' => '1'),
	array('%%NAME%%' => '2'),
	array('%%NAME%%' => '3'),
));
// output all
$t->output();
?>