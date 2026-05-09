<?php

if ($this->request->prefix == 'admin') {

	if (/*$this->Session->isLogged() || */$this->Session->user('role')!='admin') {
		$this->redirect('users/login');
	}/*else{
			 $this->redirect('');
		     }*/
} 
	$this->layout = 'connexion';

?>