 <?php 
/**
 * 
 */
class Controller{
		public $request;
		private $var = array();
		public $layout = 'default';
		private $rendered = false;
/**
 * constructeur de parametres
 */
function __construct($request = null){
	$this->Session = new Session();
    $this->Form = new Form($this);
	if ($request) {
		// on stock la request dans l'instance
	$this->request = $request;
	require ROOT.DS.'config'.DS.'hook.php';
		} 
	}
/*
permet de rendre une vue
param $view fichier à rendre (chemin ou nom de la vue)
*/
public function render($view){
if ($this->rendered) { 
	return false;
}
extract($this->var);
if (strpos($view, '/')===0) {
	$view = ROOT.DS.'view'.$view.'.php';
}else{
	$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
}
ob_start();
require($view);
$content_for_layout = ob_get_clean();
require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
$this->rendered = true;
}
/*permet de parser une ou plusieurs variables à la vue
key est la variable ou tableau des variables
$value est la valeur de la variable
*/
public function set($key,$value=null){
if (is_array($key)) {
	$this->var+=$key;
}else{
	$this->var[$key] = $value;
}
}
/*Permet de charger un model
Nous rappelons que $name signifie "page" issu de notre url dans la requete
*/
function loadModel($name){
		$file = ROOT.DS.'model'.DS.$name.'.php';
		require_once($file);
	if (!isset($this->$name)) {
		$this->$name = new $name();
		if (isset($this->Form)) {
		$this->$name->Form = $this->Form;
		}

	}
}
/*permet de gérer les erreurs 404*/

function e404($message){
	header("HTTP/1.0 404 Not Found");
	$this->set('message',$message);
	$this->render('/errors/404');
	die(); 
}

//appelle d'un controller depuis une vue

function request($controller,$action){
	$controller .= 'Controller';
	require_once ROOT.DS.'controller'.DS.$controller.'.php';
	$c = new $controller();
	 return $c->$action();
}
/*redirect
*/
function redirect($url,$code = null){
if ($code==301) {
	header("HTTP/1.1 301 Moved Permanently");
}

header("Location: ".Router::url($url));	

}




}
