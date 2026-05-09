<?php
class Entrant extends Model{
 
function entrants($id=null){
$this->loadModel('Entrant');
}
}