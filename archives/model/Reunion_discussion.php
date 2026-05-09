<?php
class Reunion_discussion extends Model{
 
 /*function  index($id){
	$this->loadModel('User');
    }*/
function index($nom_user=null){
$this->loadModel('Reunion_discussion');
}
}