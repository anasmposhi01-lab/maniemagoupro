<?php
class Session{
	
Public function __construct(){
	if (!isset($_SESSION)) {
		session_start();
		}	
	}
/*
Fonction permettant d'ajouter en $_Session un message
*/
public function setFlash($message,$type = null){
		$_SESSION['flash'] = array(
		'message' => $message,'type' =>  $type); 
		}	
//affichage de message avec la fonction flash, qui permet dans les view d'afficher un message

public function flash(){
		if (isset($_SESSION['flash']['message'])) {
			//return $_SESSION['flash']['message'];
			
           $html = '<div class="alerte-message'.$_SESSION['flash']['type'].'">
                        <p>'.$_SESSION['flash']['message'].'</p>
                    </div>' ;
			$_SESSION['flash'] = array();
			return $html;
			
		}
	}

//write permet d'enrégistrer les données captées dans la requête $user dans le usersController et de les mettre dans notre $_SESSION
public function write($key,$value){
		return $_SESSION[$key] = $value;
	}
public function isLogged(){/*$key,$value*/
	 return isset($_SESSION['User']->role);
	}
public function read($key=null){
		if ($key) {
			if (isset($_SESSION[$key])) {
			 	return $_SESSION[$key];
			 } else{
                     return false;
		            } 
        }else{
			return $_SESSION;
		     }
	}

public function user($key){ 
	if ($this->read('User')) {
		if(isset($this->read('User')->$key)){
          return $this->read('User')->$key;
		}else{
			return false;
		}	
}
return false;	
}
//=================================================================================
public function entrant($key){ 
	if ($this->read('Entrant')) {
		if(isset($this->read('Entrant')->$key)){
          return $this->read('Entrant')->$key;
		}else{
			return false;
		}	
}
return false;	
}
//=================================================================================
//=================================================================================
//=================================================================================
}
?>