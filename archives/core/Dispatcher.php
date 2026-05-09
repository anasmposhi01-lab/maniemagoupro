 <?php
/*
Dispatcher permet de charger le controller de la requete utilisateur
*/
class Dispatcher{
var $request;
/*
Fonction principal du dispatcher
charge le controller en fonction du routing
*/
function __construct(){
    $this->request = new Request();
    Router::parse($this->request->url,$this->request);
    $controller = $this->loadController();
    $action = $this->request->action;
    if ($this->request->prefix) {
      $action = $this->request->prefix.'_'.$action; 
    }
    
    //paramètre de cet objet=get_class_methods(class_name)
    if(!in_array($action,array_diff(get_class_methods($controller), get_class_methods('Controller')) )){
        $this->error('Le controller'.$this->request->controller.'n\'a pas de methode '.$action.'<a/>');
        }
    call_user_func_array(array($controller,$action),$this->request->params);
    $controller->render($action);
   }
   /*
Permet de gérer un message d'erreur
   */
function error($message){

    	  $controller = new Controller($this->request);
        //$constroller->Session = new Session();
      
        $controller->e404($message);

    }
function loadController(){
        $name = ucfirst($this->request->controller).'Controller';
        $file = ROOT.DS.'controller'.DS.$name.'.php';
       if (!file_exists($file)) {
       $this->error('Le controller'.$this->request->controller.'n\'existe pas');
        }     
        require $file;
        return new $name($this->request); 
        echo new $name($this->request);
        exit;
        $controller = new $name($this->request);
        //$constroller->Session = new Session();
        
        //$constroller->Form = new Form($constroller);
        
        return $constroller;// true


    }
}