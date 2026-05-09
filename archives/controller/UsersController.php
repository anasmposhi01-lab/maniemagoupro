 
<?php
class UsersController extends Controller{
/*
mermet la connexion des users de notre application
*/
function login($nom_user=null){
      $this->layout = 'connexion';
      if ($this->request->data) {
      //---------Initialisation d'élément-------------------------------------------
                   $data = $this->request->data;
                   $nom=$data->nom;
                   $mot_pass=$data->pass;
      //--------------Vérification d'existence d'éléments--------------------------------------
                   if (empty(htmlspecialchars(strip_tags($nom)))){
                               $this->Session->setFlash("Aucun nom Utilisateur n\'a été introduit, veuillez recommencer");
                               $this->redirect('users/login/');
                               exit;  
                               }
                   elseif (empty(htmlspecialchars(strip_tags($nom)))){
                               $this->Session->setFlash("Aucun mot de passe n\'a été introduit, veuillez recommencer");
                               $this->redirect('users/login/');
                               exit;  
                               }
      //---------Hachage de mot de passe et vérification dans la bdd-------------------------------------------

      //-------------Si l'User existe---------------------------------------
            //Controle bdd
                  else{
                      // vérification du logement du user trouvé
                   $pass_hache = sha1($mot_pass);
                   $this->loadModel('User'); 
                   $user = $this->User->findfirst(array('conditions'=>array('nom'=>$nom,'pass_hache'=>$pass_hache)));
                   $user = $this->User->findfirst(array('conditions'=>array('nom'=>$nom,'pass_hache'=>$pass_hache)));
                   $role_user =  $user->role;
                   $nom_user  =  $user->nom;
                   $this->Session->write('User',$user);
                   if ($this->Session->isLogged()) {
                        
                        /*Recupération des des identités du user, la date et l'heure de sa connection à notre serveur*/
                        $nom                   = $this->Session->user('nom');
                        $pst_noms              = $this->Session->user('pst_noms');
                        $pr_noms               = $this->Session->user('pr_noms');
                        $role                  = $this->Session->user('role');
                        $sexe                  = $this->Session->user('sexe');
                        $commentaire_con_decon = "connexion";
                        $date_connexion        = date('Y-m-d');
                        $heure_connexion       = date("H:i:s");

                        $this->loadModel('Frequence_user');
                        //Insertion dans la bdd
                        $this->Frequence_user->save(array(
                              'nom'                   =>    $nom, 
                              'pst_noms'              =>    $pst_noms, 
                              'pr_noms'               =>    $pr_noms, 
                              'role'                  =>    $role, 
                              'sexe'                  =>    $sexe, 
                              'date_connexion'        =>    $date_connexion, 
                              'heure_connexion'       =>    $heure_connexion, 
                              'commentaire_con_decon' =>    $commentaire_con_decon
                              ));
                      $mes_users = array('adm_principal','Assistant_Principal','ops_1','ops_2','gouverneur','Parsec','courrier_kin');
                      if ($this->Session->user('role')!=''){ 
                                                             $this->redirect('gestionnaire/acceuil_admin/'.$this->Session->user('nom'));
                                                             exit;
                                                             }
                      else{// le user n'est pas logé dans la session
                             $this->Session->setflash('Veuillez vous inscrire svp');
                             $this->redirect('users/login/');
                             exit; 
                            }
                    }else{// le user n'est pas logé dans la session
                             $this->Session->setflash('Veuillez vous inscrire svp, Ok!');
                             $this->redirect('users/login/');
                             exit; 
                            }
                    }

      }//else{}
}

/*=================================================================================================*/

function logout(){
 	/*Recupération des des identités du user, la date et l'heure de sa déconnection à notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $commentaire_con_decon = "déconnexion";
      $date_connexion = date('Y-m-d');
      $heure_connexion = date("H:i:s");
      $this->loadModel('Frequence_user');
      //Insertion dans la bdd
      $this->Frequence_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
                                         'role' =>  $role, 
                                         'sexe' => $sexe, 
                                         'date_connexion' => $date_connexion, 
                                         'heure_connexion' => $heure_connexion, 
                                         'commentaire_con_decon' => $commentaire_con_decon
                                         ));
unset($_SESSION['User']);
$this->Session->setFlash('Vous êtes maintenant déconnecté');
$this->redirect('users/login');
}

//============================================================================================
function printers_frequence_user(){

$mes_users = array('adm_principal');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à Rapport du lociel, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->sortants();
$this->orientes();
$this->accuses();
$this->arret();
$this->total_reunion();
$this->total_ordre_mission();
$this->discour();
$this->total_com_affect();
$this->layout = 'gestion_acceuil';
$this->loadModel('Frequence_user');
     $perPage = 8;
     $d['Frequence'] = $this->Frequence_user->find(array(
          'fields' => 'id, nom, pst_noms, pr_noms, role, sexe, date_connexion, heure_connexion, commentaire_con_decon',
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['total_Frequence'] = $this->Frequence_user->trouver_tout();
     $d['page'] = ceil($d['total_Frequence'] / $perPage);
return $this->set($d);
}

//============================================================================================

function printers_action_user(){

$mes_users = array('adm_principal');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès aux Actions du lociel, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
    $this->entrants();
    $this->sortants();
    $this->orientes();
    $this->accuses();
    $this->arret();
    $this->total_reunion();
    $this->total_ordre_mission();
    $this->discour();
    $this->total_com_affect();

    $this->layout = 'gestion_acceuil';
    $this->loadModel('Action_user');
               $perPage = 8;
               $d['action_users'] = $this->Action_user->find(array(
                    'fields' =>  'id, nom, pst_noms, pr_noms, role, sexe, date_action, heure_action, actions, commentaire_action, type, num, objet, destinateur, nom_file',
                    'limit' => ($this->request->page-1)*$perPage.','.$perPage));
               $d['total_action_users'] = $this->Action_user->trouver_tout();
               $d['page'] = ceil($d['total_action_users'] / $perPage);

    return $this->set($d);
}
function uploader_user($nom_user=null){

$mes_users = array('adm_principal');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrément de droit d'acces, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
	//Permet d'enrégistrer les Users de cette application
        $this->entrants();
        $this->sortants();
        $this->orientes();
        $this->accuses();
        $this->arret();
        $this->total_reunion();
        $this->discour();
        $this->users();
        $this->total_com_affect();
        $this->total_ordre_mission();
        $this->layout = 'gestion_acceuil';
        $this->loadModel('User');
  //if ('adm'!=$this->Session->user('role')) {$this->redirect('users/login/');}
  if ($this->request->data && !empty($_FILES['file']['name'])) {

                    $data = $this->request->data;
                    $name=$_FILES['file']['name']; 
                    $t_name=$_FILES['file']['tmp_name'];
                    $error=$_FILES['file']['error'];
                    $type = $_FILES['file']['type'];

        if ($data->pass_propre!==$data->pass_propre1) {
                  $this->Session->setFlash("Les deux mots de passe doivent être identiques");
                  $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
                  exit; 
        }

      if(strpos($type, 'image')!== false){
        //$ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
        //$ext_file = strtolower($ext);
        
        //$tab_ext = array('jpg, jpeg, gif, png, bmp, JPG, JPEG, GIF, PNG, BMP');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé

        $dir = WEBROOT.DS.'user'.DS.date('Y-m');//creéation du dossier de stockage $dir

        if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un

        /*if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table*/
          move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader

       
            if (empty(htmlspecialchars(strip_tags($this->request->data->nom)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom)))){
                  $this->Session->setFlash("Vérifiez le champs NOM et continuer");
                  $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
                  exit;  
                  }
            if (empty(htmlspecialchars(strip_tags($this->request->data->pst_noms)))||is_int(htmlspecialchars(strip_tags($this->request->data->pst_noms)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->pst_noms)))){
                  $this->Session->setFlash("Vérifiez le champs Post-nom et continuer");
                  $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
                  exit;  
                  }
            if (empty(htmlspecialchars(strip_tags($this->request->data->pr_noms)))||is_int(htmlspecialchars(strip_tags($this->request->data->pr_noms)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->pr_noms)))){
                  $this->Session->setFlash("Vérifiez le champs Prénom et continuer");
                  $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
                  exit;   
                  }
            if (empty(htmlspecialchars(strip_tags($this->request->data->role)))||is_int(htmlspecialchars(strip_tags($this->request->data->role)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->role)))){
                  $this->Session->setFlash("Vérifiez le champs Fonction et continuer");
                  $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
                  exit;   
                  }
            if (empty(htmlspecialchars(strip_tags($this->request->data->sexe)))||is_int(htmlspecialchars(strip_tags($this->request->data->sexe)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->sexe)))){
                  $this->Session->setFlash("Vérifiez le champs sexe et continuer");
                  $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
                  exit;  
                  }
            if (empty(htmlspecialchars(strip_tags($this->request->data->pass_propre)))||is_int(htmlspecialchars(strip_tags($this->request->data->pass_propre)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->pass_propre)))){
                  $this->Session->setFlash("Vérifiez le champs mot de passe et continuer");
                  $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
                  exit;   
                  } 
            $d['total_user_avant'] = $this->User->trouver_tout();
            $this->User->save(array(
                            'role'       =>  htmlspecialchars(strip_tags($this->request->data->role)),
                            'nom'        =>  htmlspecialchars(strip_tags($this->request->data->nom)),
                            'pst_noms'   =>  htmlspecialchars(strip_tags($this->request->data->pst_noms)),
                            'pr_noms'    =>  htmlspecialchars(strip_tags($this->request->data->pr_noms)),
                            'sexe'       =>  htmlspecialchars(strip_tags($this->request->data->sexe)),
                            'date_enre'  =>  htmlspecialchars(strip_tags($this->request->data->date_enre)),
                            'heure_enre' =>  htmlspecialchars(strip_tags($this->request->data->heure_enre)),
                            'pass_hache' =>  sha1($this->request->data->pass_propre),
                            'pass_propre'=>  htmlspecialchars(strip_tags($this->request->data->pass_propre)),
                            'file'       =>  date('Y-m').'/'.$_FILES['file']['name']
                            ));
            $d['total_user_apres'] = $this->User->trouver_tout();
            if ($d['total_user_apres']>$d['total_user_avant']) {//si le nombre des users après enrégistrement n'est pas supérieur à celui d'avant, il y a eu donc echec d'enrégistrement, sinon, il y a eu enrégistrement
            $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau Utilisateur dans le Serveur *");
            $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
            exit;
            }else{//si le nombre des users après enrégistrement n'est pas supérieur, il y a eu donc echec d'enrégistrement
             $this->Session->setFlash("La photo choisie est de mauvaise qualité, veuillez recommencer");
             $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
             }

       /* }else{//Fin test d'extension et d'enrégistrement
             $this->Session->setFlash("La photo choisie est de mauvaise qualité");
             $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
             } */
        
      }else{//Fin $error==0
            $this->Session->setFlash("Ce fichier n'est une image ou pas supporté par le serveur");
            $this->redirect('users/uploader_user/'.$this->Session->user('nom'));
            exit;
            }
  }
}//Fin fonction uploader user
//============================================================================================
function printers_user(){

$mes_users = array('adm_principal');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à la liste des Users de ce Logiciel, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
	//Permet d'afficher les Users de cette application
               $this->entrants();
               $this->sortants();
               $this->orientes();
               $this->accuses();
               $this->arret();
               $this->total_reunion();
               $this->discour();
               $this->users();
               $this->total_com_affect();
               $this->total_ordre_mission();
               $this->layout = 'gestion_acceuil';
               $this->loadModel('User');
               $perPage = 8;
               $d['users'] = $this->User->find(array(
                  'fields' => `id,role,nom, pst_noms, pr_noms, sexe, date_enre, heure_enre, pass_hache, pass_propre, file`,
                  'limit' => ($this->request->page-1)*$perPage.','.$perPage));
               $d['total_users'] = $this->User->trouver_tout();
               $d['page'] = ceil($d['total_users'] / $perPage);
               return $this->set($d);
}
//============================================================================================

//Coptation du total des toutes mes bases

function entrants($nom_user=null){
  $this->loadModel('Entrant');
  $d['total_entrants'] = $this->Entrant->trouver_tout();
  return $this->set($d);
}
//============================================================================================
function sortants($nom_user=null){
  $this->loadModel('Sortant');
  $d['total_sortants'] = $this->Sortant->trouver_tout();
  return $this->set($d);
}
//============================================================================================
function orientes($nom_user=null){
$this->loadModel('Oriente');
$d['total_orientes'] = $this->Oriente->trouver_tout();
return $this->set($d);
}
//============================================================================================
function accuses($nom_user=null){
$this->loadModel('Accuse');
$d['total_accuses'] = $this->Accuse->trouver_tout();
return $this->set($d);
}
//============================================================================================
function arret($nom_user=null){
$this->loadModel('Arrete');
$d['total_arret'] = $this->Arrete->trouver_tout();
return $this->set($d);
}
//======================================
function total_reunion($nom_user=null){
    $this->loadModel('Reunion');
               $d['total_reunion'] = $this->Reunion->trouver_tout();
  return $this->set($d);
}
//============================================================================================
//============================================================================================
function discour($nom_user=null){
$this->loadModel('Discour');
$d['total_discours'] = $this->Discour->trouver_tout();
return $this->set($d);
}
//============================================================================================
//============================================================================================
function users($nom_user=null){
$this->loadModel('User');
$d['total_user'] = $this->User->trouver_tout();
return $this->set($d);
}
//============================================================================================
//============================================================================================
function total_ordre_mission($nom_user=null){
$this->loadModel('Ordres_mission');
$d['total_OR'] = $this->Ordres_mission->trouver_tout();
return $this->set($d);
}
//======================================
//======================================
function total_com_affect($nom_user=null){
    $this->loadModel('Comm_affectation');
               $d['total_comm_affect'] = $this->Comm_affectation->trouver_tout();
  return $this->set($d);
}
//============================================================================================

//Coptation des toutes mes bases //$total_user_apres

//============================================================================================
function modifie_user($id=null){
  $this->entrants();
  $this->sortants();
  $this->orientes();
  $this->accuses();
  $this->arret();
  $this->reunion(); 
  $this->discour();
  $this->total_com_affect();
  $this->users();
  $this->total_ordre_mission();
  $this->loadModel('User');
$mes_users = array('adm_principal');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("La modification d'un User, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }

  $this->layout = 'gestion_acceuil';

  if ($this->request->data) {
                  $data = $this->request->data;
                  $id   =  $data->id;
                  $role   =  $data->role;
                  $nom   =  $data->nom;
                  $pst_noms   =  $data->pst_noms;
                  $pr_noms   =  $data->pr_noms;
                  $sexe   =  $data->sexe;
                  $date_enre   =  $data->date_enre;
                  $heure_enre   =  $data->heure_enre;
                  $pass_propre   =  $data->pass_propre;
                  $pass_hache = sha1($data->pass_propre);
                  $file = $data->file;

            if (empty(htmlspecialchars(strip_tags($nom)))||is_int(htmlspecialchars(strip_tags($nom)))||is_numeric(htmlspecialchars(strip_tags($nom)))){
                  $this->Session->setFlash("Vérifiez le champs NOM et continuer");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;  
                  }
            if (empty(htmlspecialchars(strip_tags($pst_noms)))||is_int(htmlspecialchars(strip_tags($pst_noms)))||is_numeric(htmlspecialchars(strip_tags($pst_noms)))){
                  $this->Session->setFlash("Vérifiez le champs Post-nom et continuer");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;  
                  }
            if (empty(htmlspecialchars(strip_tags($pr_noms)))||is_int(htmlspecialchars(strip_tags($pr_noms)))||is_numeric(htmlspecialchars(strip_tags($pr_noms)))){
                  $this->Session->setFlash("Vérifiez le champs Prénom et continuer");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;   
                  }
            if (empty(htmlspecialchars(strip_tags($role)))||is_int(htmlspecialchars(strip_tags($role)))||is_numeric(htmlspecialchars(strip_tags($role)))){
                  $this->Session->setFlash("Vérifiez le champs Fonction et continuer");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;   
                  }
            if (empty(htmlspecialchars(strip_tags($sexe)))||is_int(htmlspecialchars(strip_tags($sexe)))||is_numeric(htmlspecialchars(strip_tags($sexe)))){
                  $this->Session->setFlash("Vérifiez le champs sexe et continuer");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;  
                  }
            if (empty(htmlspecialchars(strip_tags($pass_propre)))||is_int(htmlspecialchars(strip_tags($pass_propre)))||is_numeric(htmlspecialchars(strip_tags($pass_propre)))){
                  $this->Session->setFlash("Vérifiez le champs mot de passe et continuer");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;   
                  } 
  //=====================================================================
            if (empty(htmlspecialchars(strip_tags($date_enre)))||is_int(htmlspecialchars(strip_tags($date_enre)))||is_numeric(htmlspecialchars(strip_tags($date_enre)))){
                  $this->Session->setFlash("L'insertion de la date automatique fait defaut");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;   
                  }
            if (empty(htmlspecialchars(strip_tags($heure_enre)))||is_int(htmlspecialchars(strip_tags($heure_enre)))||is_numeric(htmlspecialchars(strip_tags($heure_enre)))){
                  $this->Session->setFlash("L'insertion de l'heure' automatique fait defaut");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;   
                  }
            if (empty(htmlspecialchars(strip_tags($pass_hache)))||is_int(htmlspecialchars(strip_tags($pass_hache)))||is_numeric(htmlspecialchars(strip_tags($pass_hache)))){
                  $this->Session->setFlash("L'insertion de mot de pass haché automatique fait defaut");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;  
                  }
            if (empty(htmlspecialchars(strip_tags($file)))||is_int(htmlspecialchars(strip_tags($file)))||is_numeric(htmlspecialchars(strip_tags($file)))){
                  $this->Session->setFlash("L'insertion de la photo automatique fait defaut");
                  $this->redirect('users/printers_user/'.$this->Session->user('nom'));
                  exit;   
                  } 
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                  $nom1 = $this->Session->user('nom');
                  $pst_noms1 = $this->Session->user('pst_noms');
                  $pr_noms1 = $this->Session->user('pr_noms');
                  $role = $this->Session->user('role');
                  $sexe = $this->Session->user('sexe');
                  $date_action = date('Y-m-d');
                  $heure_action = date("H:i:s");
                  $action = "Modification";
                  $commentaire_action = "Un User a été Modifié";

                  $type = $nom.' - '.$pst_noms.' - '.$pr_noms.'(-> Nom, Post-nom et Prénom)';
                  $num = ''; 
                  $objet = $date_enre.' (Date de modification)';
                  $destinateur = $heure_enre.' (Heure de Modification de cet User)';
                  $nom_file = $file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom1, 
                                         'pst_noms'=> $pst_noms1, 
                                         'pr_noms' =>  $pr_noms1, 
                                         'role' =>  $role, 
                                         'sexe' => $sexe, 
                                         'date_action' => $date_action, 
                                         'heure_action' => $heure_action, 
                                         'actions' => $action,
                                         'commentaire_action' => $commentaire_action,
                                         'type' => $type,
                                         'num' => $num,
                                         'objet' => $objet,
                                         'destinateur' => $destinateur,
                                         'nom_file' => $nom_file
                                         ));
          $this->User->save($data);
          $this->Session->setFlash("Bravo! Vous venez de modifier les identités d'un Utilisateur dans le Serveur *");
          $this->redirect('users/printers_user/');
          exit;
}else{
        $cond = array('id'=>$id);
        $d['modifie_user'] = $this->User->find(array('conditions' => $cond));
        return $this->set($d);
       }  

}//Fin de la fonction

//========================================================================================================


}
