
<?php
$debut = microtime(true);
define('WEBROOT' ,dirname(__FILE__));
define('ROOT' ,dirname(WEBROOT));

/*
echo ROOT; donne ce schema=C:\wamp\www\cabminurb\hab
*/
define('DS' ,DIRECTORY_SEPARATOR);
define('CORE' ,ROOT.DS.'core');

/*
echo CORE; donne ce schama=C:\wamp\www\cabminurb\hab\core
*/
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));
require CORE.DS.'includes.php';
new Dispatcher();

?>
<div style="position:fixed; botton:0;background: #900; color: #FFF; line-height: 30px; height: 30px; left: 0; right: 0;padding-left: 10px; ">
<?php
echo 'Page générée en '.round(microtime(true)-$debut,5).' Secondes';
?>	
</div>


