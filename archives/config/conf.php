<?php
/**
 * 
 */
class Conf{
static $debug = 1;
static $databases=array(
	'default'=>array(
		'host'=>'localhost',
		'database'=>'archvages_gouv_maniema',
		'login'=>'root',
		'password'=>''
	));
}

Router::prefix('cockpit','admin');
Router::connect('','users/login');
Router::connect('cockpit','cockpit/posts/index');
Router::connect('blog/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('blog/*','posts/*');

//Router::connect('blog/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
//Router::connect('blog/*','posts/*');
//Router::connect('','posts/index');
//Router::connect('cockpit','cockpit/posts/index');
//Router::connect('post/:slug-:id','posts/view/id:(?P<id>[0-9]+)/slug:(?P<slug>[a-z0-9\-]+)');
//Router::connect('/','posts/index');
//Router::connect('blog/:action','posts/:action');
//Router::connect('blog/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
 //Router::connect('blog/:action','posts/:action');