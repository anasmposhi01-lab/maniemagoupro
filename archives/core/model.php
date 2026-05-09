
<?php
class Model{
	
	static $connections = array();
    public $conf = 'default';
	public $table = false;
	public $primaryKey = 'id';
    public $db;
    public $id;
    public $errors = array();
    public $form;
public function __construct(){
 //J'unitialise quelque variables
	if($this->table === false){
	$this->table =strtolower(get_class($this)).'s' ;
}
//Je me connecte à la base
	//$conf = conf::$databases[$this->db];
$conf = conf::$databases[$this->conf];
//$conf = conf::$databases[$this->db];
    // pour interrompre un affichage double:
  if (isset(Model::$connections[$this->conf])) {
   $this->db = Model::$connections[$this->conf];
    return true;
}
	try {
			$pdo = new PDO(
				'mysql:host='.$conf['host'].
				';dbname='.$conf['database'].
				';',
				$conf['login'],
				$conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8')
			);
          $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
			Model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;	
			} catch (PDOException $e) {
				if (Conf::$debug >= 1) {
				die($e->getmessage());
				}else{
				die('Impossible de se connecter à la base de donnée');	
				}
		}
    //if ($this->table===false) {
      // $this->table = strtolower(get_class($this)).'s';
    //}
}
/*
Permet de valider des données
@param $data données à valider
*/
function validates($data){
foreach ($this->validates as $k => $v) {
    $errors = array();
    if (!isset($data->$k)) {
        $errors[$k] = $v['message'];
    }else{
        if ($v['rule'] == 'NotEmpty') {
            if (empty($data->$k) ) {
              $errors[$k] = $v['message'];
            }
        }elseif (!preg_match('/^'.$v['rule'].'$/', $data->$k)) {
            $errors[$k] = $v['message'];
        }
    }
}
$this->errors = $errors;
if ($this->Form) {
    $this->Form->errors = $errors;
}
if (empty($errors)) {
    return true;
}
return false;
 }
//$res=$con->prepare("SELECT * FROM `courriers_sortant` WHERE EXPEDITEUR like '%$key%' ORDER BY `ID` DESC ET ASC");

 //

public  function find($req=array()){
    $sql = ' SELECT ';
     if (isset($req['fields'])) {
     	if(is_array($req['fields'])){
     	                            $sql .= implode(', ',$req['fields']);	
     	                            }else{
                                         $sql .= $req['fields'];
                                         }	
        }else{
             $sql .= '*';
             }
    $sql .= ' FROM '.$this->table. ' as '.get_class($this).'';
// construction de conditions
     if (isset($req['conditions'])) {
        $sql .= ' WHERE ';//.$req['conditions'];
     	if (!is_array($req['conditions'])) {
     		$sql .= $req['conditions'].'ORDER BY id DESC';

     	}else{
              $cond = array();
     	      foreach($req['conditions'] as $k=>$v) {
     		  if (!is_numeric($v)) {
     	         $v = '"'.$v.'"';//.mysql_escape_string($v).'"';
     		     }
     	      $cond[] = "$k = $v";
     	     }
     	$sql .= implode(' AND ', $cond); 
     	}
       }
     if (isset($req['limit'])) {
                               $sql .= ' LIMIT '.$req['limit'];
                               }
     $pre = $this->db->prepare($sql);
     $pre->execute();
     return $pre->fetchAll(PDO::FETCH_OBJ);
     } 
/*
cette fonction d'afficher que le premier element courant dans notre table grace à la balise 'current()'
*/
public function dernier_enre($req){
return max($this->find($req));
}
//===============================================
public function findFirst($req){
return current($this->find($req));
}

public function findCount($condition){
      $res= $this->findFirst(array(
        'fields'=>' COUNT('.$this->primaryKey.') as count','conditions' => $condition
    )); 
      return $res->count;
  } 
public function trouver_tout(){
      $res= $this->findFirst(array(
        'fields'=>' COUNT('.$this->primaryKey.') as count'
    )); 
      return $res->count;
  }
Public function delete($id){
	$sql= "DELETE FROM `{$this->table}` WHERE {$this->primaryKey} = $id";
	$this->db->query($sql);
}

Public function save($data){
    $key = $this->primaryKey;
    $fields = array(); 
    $d = array();
    //if (isset($data->$key)) unset($data->$key);
    foreach ($data as $k=>$v) {
    if ($k!=$this->primaryKey) {
     $fields[] = "$k=:$k";
     $d[":$k"] = $v;
    }elseif (!empty($v)) {
     $d[":$k"] = $v;
    }
 
     }
    if (isset($data->$key) && !empty($data->$key)) {
     $sql= 'UPDATE '. $this->table. ' SET '.implode(',',$fields). ' WHERE '.$key.'=:'.$key;
     $action = 'update';
    }
    else{
    //if (isset($data->$key) unset($data->$key);
    $sql= 'INSERT INTO '. $this->table. ' SET '.implode(',',$fields);
    //$this->id = $data->$key;
    $action = 'insert';
    }
    
    $pre = $this->db->prepare($sql);
    //array('name' => false);
    $pre->execute($d);
     $this->id = $this->db->lastInsertId();
     //if ($action == 'insert')  stInsertId();
     //header("Location: ".Router::url('admin/posts/edit'));
     }
//Fonction qui permet d'insérer %like% pour une recheche approfondue

public  function findlike($req=array()){
    $sql = ' SELECT ';
    //s'il existe des champs(fields) de la BDD prédéfinis, on les ajoute dans la requête
    //Par exemple:SELECT id,nom,post_nom,prénom FROM `courriers_sortant`
    if (isset($req['fields'])) {
    if(is_array($req['fields'])){
      $sql .= implode(', ',$req['fields']);   
      }else{$sql .= $req['fields'];}  
    }else{$sql .= '*';}//s'il n'ya pas de fields, on met * donc on selectionne tout 
    $sql .= ' FROM '.$this->table.' as '.get_class($this).'';

// construction de conditions
     if (isset($req['conditions'])) {
        $sql .= ' WHERE ';
        if (!is_array($req['conditions'])) {
            $sql .= $req['conditions'];

        }else{
              $cond = array();
              foreach($req['conditions'] as $k=>$v) {
              if (!is_numeric($v)) {
                 $v = '"'.$v.'"';//echo $v = '"'.mysql_escape_string($v).'"';
                 }
              $cond[] = "$k like '%$v%' "; //ORDER BY `ID` DESC
             } 
        $sql .= implode(' AND ', $cond);
        //echo $sql;exit;
        }
       }
     if (isset($req['limit'])) {
                               $sql .= ' LIMIT '.$req['limit'];
                               }
     $pre = $this->db->prepare($sql);
     $pre->execute();
     return $pre->fetchAll(PDO::FETCH_OBJ);
     } 
//========================================================================
/*
if (str_contains($string, 'Lazy')) {
echo 'The string "Lazy" was found in the string';
} else {
echo '"Lazy" was not found because the case does not match';
}

*/
public  function si_contient($req=array()){
    $sql = ' SELECT ';
    $sql .= '*'; 
    $sql .= ' FROM '.$this->table.' as '.get_class($this).'';
     if (isset($req['conditions'])) {
        $sql .= ' WHERE ';
        if (!is_array($req['conditions'])) {
            $sql .= $req['conditions'];

        }else{
              $cond = array();
              foreach($req['conditions'] as $k=>$v) {
              $cond[] = "$k like '%$v%' ORDER BY `ID` ASC";
             } 
        $sql .= implode(' AND ', $cond);
        }
       }
     if (isset($req['limit'])) {
                               $sql .= ' LIMIT '.$req['limit'];
                               }
     $pre = $this->db->prepare($sql);
     $pre->execute();
     return $pre->fetchAll(PDO::FETCH_OBJ);

     } 
//========================================================================
public  function modif($data){

    $key = $this->primaryKey;
    $fields = array(); 
    $d = array();
    //if (isset($data->$key)) unset($data->$key);
    foreach ($data as $k=>$v) {
    if ($k!=$this->primaryKey) {
     $fields[] = "$k=:$k";
     $d[":$k"] = $v;
    }elseif (!empty($v)) {
     $d[":$k"] = $v;
    }
 
     }
    if (isset($data->$key) && !empty($data->$key)) {
     $sql= 'UPDATE '. $this->table. ' SET '.implode(',',$fields). ' WHERE '.$key.'=:'.$key;

     //$this->id = $data->$key;
     $action = 'update';
    $pre = $this->db->prepare($sql);
    //array('name' => false);
    $pre->execute($d);
     $this->id = $this->db->lastInsertId();
    }
    
    


 //$req=mysqli_query($con, "UPDATE courriers_sortant SET DATE='$date_courr', NUMERO='$numero_courr', EXPEDITEUR='$expediteur_courr', OBJET='$objet_courr' WHERE ID=$id");
     }

//=================================================== 



}