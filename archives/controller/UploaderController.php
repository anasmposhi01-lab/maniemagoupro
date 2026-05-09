<?php
class UploaderController extends Controller{

//============================================================================================
/*=====================================================================================================================================*/

//Capture des totaux de bdd

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
/*===================================================================================================*/
//============================================================================================
function total_ordre_mission($nom_user=null){
$this->loadModel('Ordres_mission');
$d['total_OR'] = $this->Ordres_mission->trouver_tout();
return $this->set($d);
}
//======================================
function total_com_affect($nom_user=null){
    $this->loadModel('Comm_affectation');
               $d['total_comm_affect'] = $this->Comm_affectation->trouver_tout();
  return $this->set($d);
}
//============================================================================================

function courriers_entrants(){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement des Courriers Entrants, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin, à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
        $this->layout = 'gestion_acceuil';
        $this->entrants();
        $this->sortants();
        $this->orientes();
        $this->accuses();
        $this->arret();
        $this->total_reunion();
        $this->total_ordre_mission();
        $this->discour();
        $this->total_com_affect();
        $this->loadModel('Entrant');

  if ($this->request->data && !empty($_FILES['file']['name'])) {
        
                   $data = $this->request->data;
        
                   $objet = $data->objet;      
        
                   $name=$_FILES['file']['name']; 
        
                   $t_name=$_FILES['file']['tmp_name'];
        
                   $error=$_FILES['file']['error'];

      if($error===0){

                   $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
                   $ext_file = strtolower($ext);
                   $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
                   $dir = WEBROOT.DS.'courriers_entrants'.DS.date('Y-m');//creéation du dossier de stockage $dir
                   if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre

        if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table
          move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader
          
          //Test des autres données du formulaire
          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("De quel type de courrier s'agit-il svp? Delectionner le type de courrier et continuer");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                  $this->Session->setFlash("entrez le numéro du courrier, numéro attribué par nos services lors de sa reception pour continuer ou renvoyer-le à notre reception pour attribution de numéro. Merci");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Le format date saisi est mauvais, veuillez recommencer");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($objet)))||is_int(htmlspecialchars(strip_tags($objet)))||is_numeric(htmlspecialchars(strip_tags($objet)))){
                  $this->Session->setFlash("l'objet du Courrier est très important pour l'identification, vérifiez et continuer");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->expediteur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->expediteur)))){
                  $this->Session->setFlash("Le le nom de l'expéditeur du courrier ne peut-être vide ou numérique, veuillez corriger et recommencer");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_expediteur)))||is_int(htmlspecialchars(strip_tags($this->request->data->date_expediteur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->date_expediteur)))){
                  $this->Session->setFlash("le format de la date saisi n'a pas été bien identifié par notre Serveur");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone)))){
                  $this->Session->setFlash("Vérifiez le numéro de téléphone saisi et continuer");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  }
          else{
          $d['total_entrant_avant'] = $this->Entrant->trouver_tout();

          $this->Entrant->save(array(
                 'num_c'=>htmlspecialchars(strip_tags($this->request->data->num_c)),
                 'objet'=>htmlspecialchars(strip_tags($this->request->data->objet)), 
                 'nom_sign'=>htmlspecialchars(strip_tags($this->request->data->nom_sign)),
                 'date_expediteur'=>htmlspecialchars(strip_tags($this->request->data->date_expediteur)),
                 'num_phone'=>htmlspecialchars(strip_tags($this->request->data->num_phone)),
                 'expediteur'=>htmlspecialchars(strip_tags($this->request->data->expediteur)),
                 'type'=>htmlspecialchars(strip_tags($this->request->data->type)),
                 'date_enre'=>date('d-m-Y'),
                 'heure_enre'=>date('H:i:s'),
                 'file'=>date('Y-m').'/'.$_FILES['file']['name']
                  ));

            $d['total_entrant_apres'] = $this->Entrant->trouver_tout();

            if ($d['total_entrant_apres']>$d['total_entrant_avant']) {//si le nombre des Courriers entant, après enrégistrement n'est pas supérieur à celui d'avant, il y a eu donc echec d'enrégistrement, sinon, il y a eu nouveau enrégistrement
                  $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau Courrier entrant dans le Serveur  *");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;
                  }else{//si le nombre des users après enrégistrement n'est pas supérieur, il y a eu donc echec d'enrégistrement
                  $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité. Créez un autre, puis continuer");
                  $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
                  exit;
                  }

              }


        }else{//Fin test d'extension et d'enrégistrement
             $this->Session->setFlash("l'extension de ce fichier n'est pas supportée par le notre serveur");
             $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
             exit;
             }
        
      }else{//Fin $error==0
            $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
            $this->redirect('uploader/courriers_entrants/'.$this->Session->user('nom'));
            exit;
            }
  }//Fin request_data
}//Fin courriers_entrants

//============================================================================================
//=============================================================================================
function courriers_sortants($nom=null, $id=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement des Courriers Sortants, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin, à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                   $this->layout = 'gestion_acceuil';
                   $this->entrants();
                   $this->sortants();
                   $this->orientes();
                   $this->accuses();
                   $this->arret();
                   $this->total_reunion();
                   $this->total_ordre_mission();
                   $this->discour();
                   $this->total_com_affect();
                   $this->loadModel('Sortant');
    
  if ($this->request->data && !empty($_FILES['file']['name'])) {

                   
                   $name=$_FILES['file']['name']; 
                   
                   $t_name=$_FILES['file']['tmp_name'];
                   
                   $error=$_FILES['file']['error'];

      if($error===0){
                   
                   $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
                   
                   $ext_file = strtolower($ext);
                   
                   $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
                   
                   $dir = WEBROOT.DS.'courriers_sortants'.DS.date('Y-m');//creéation du dossier de stockage $dir
                   
                   if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre

        if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table
                  move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader

          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("De quel type de courrier s'agit-il svp? Delectionner le type de courrier et continuer");
                  $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                  $this->Session->setFlash("Le numéro du Courrier sortant est très important, veuillez compléter et continuer");
                  $this->redirect('gestionnaire/enre_membre_simple/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("L'objet de ce courrier a été homis ou saisi en numérique, veuillez recommencer");
                  $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Le nom du Signateur de ce courrier a été homis ou saisi en numérique, veuillez recommencer");
                  $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_sign)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->date_sign)))){
                  $this->Session->setFlash("la date est en format non pris en compte par notre serveur");
                  $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone)))||is_int(!htmlspecialchars(strip_tags($this->request->data->num_phone)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->num_phone)))){
                  $this->Session->setFlash("Veuillez revoir le numéro de téléphone saisi");
                  $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_int(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->destinateur)))){
                  $this->Session->setFlash("Vous devez spécifier le nom du destinateur de ce courrier svp");
                  $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                  exit;
                  }
          else{
                 $d['total_sortant_avant'] = $this->sortant->trouver_tout();
                 $this->Sortant->save(array(
                  'num_c'=>htmlspecialchars(strip_tags($this->request->data->num_c)),
                  'objet'=>htmlspecialchars(strip_tags($this->request->data->objet)), 
                  'nom_sign'=>htmlspecialchars(strip_tags($this->request->data->nom_sign)),
                  'date_sign'=>htmlspecialchars(strip_tags($this->request->data->date_sign)),
                  'num_phone'=>htmlspecialchars(strip_tags($this->request->data->num_phone)),
                  'destinateur'=>htmlspecialchars(strip_tags($this->request->data->destinateur)),
                  'type'=>htmlspecialchars(strip_tags($this->request->data->type)),
                  'date_enre'=>date('d-m-Y'),
                  'heure_enre'=>date('H:i:s'),
                  'file'=>date('Y-m').'/'.$_FILES['file']['name']
                  ));
                 $d['total_sortant_apres'] = $this->sortant->trouver_tout();
                 if ($d['total_sortant_apres']>$d['total_sortant_avant']) {//
                    $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau Courrier sortant dans le Serveur  *");
                    $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                    exit;}else{//
                               $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité. Créez un autre, puis continuer");
                               $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
                               exit;
                               } 
              } 
          

          }else{//Fin test d'extension et d'enrégistrement

               $this->Session->setFlash("l'extension de ce fichier n'est pas supportée par le notre serveur");
               $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
               exit;

               }
        
      }else{//Fin $error==0
              $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
              $this->redirect('uploader/courriers_sortants/'.$this->Session->user('nom'));
              exit;
              }
  }//Fin request_data
}//Fin courriers_sortants

//============================================================================================
//=============================================================================================
function courriers_entrants_orientes($nom=null, $id=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur','ops_1','ops_2');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement des Courriers Entrants Orientés, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                   $this->layout = 'gestion_acceuil';
                   $this->entrants();
                   $this->sortants();
                   $this->orientes();
                   $this->accuses();
                   $this->arret();
                   $this->total_reunion();
                   $this->discour();
                   $this->total_ordre_mission();
                   $this->total_com_affect();
                   $this->loadModel('Oriente');
                   //if ('adm'!=$this->Session->user('role')) {$this->redirect('users/login/');}
  
  if ($this->request->data && !empty($_FILES['file']['name'])) {
                   
                   $name=$_FILES['file']['name']; 
                   
                   $t_name=$_FILES['file']['tmp_name'];
                   
                   $error=$_FILES['file']['error'];

      if($error===0){
                   $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
                   $ext_file = strtolower($ext);
                   $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
                   $dir = WEBROOT.DS.'courriers_orientes'.DS.date('Y-m');//creéation du dossier de stockage $dir
                   if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre
        if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table
          move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader

          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("Veuillez spécifier le type de courrier soumis pour traitement");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->exploitant)))||is_int(htmlspecialchars(strip_tags($this->request->data->exploitant)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->exploitant)))){
                  $this->Session->setFlash("Veuillez spécifier le la fonction ou nom de l'exploitant de ce courrier soumis pour traitement");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                  $this->Session->setFlash("Veuillez spécifier le Numéro de ce courrier soumis pour traitement");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Veuillez spécifier le Nom  de l'expéditeur de ce courrier soumis pour traitement");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone_destina)))){
                  $this->Session->setFlash("Veuillez spécifier le Numéro de téléphone de l'expéditeur de ce courrier soumis pour traitement");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("Veuillez spécifier l'objet de ce courrier qui est orienté");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_rient)))||is_int(htmlspecialchars(strip_tags($this->request->data->date_rient)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->date_rient)))){
                  $this->Session->setFlash("Veuillez spécifier la date à laquelle l'Autorité a orientaté ce courrier pour traitement");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->gouv_orient)))||is_int(htmlspecialchars(strip_tags($this->request->data->gouv_orient)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->gouv_orient)))){
                  $this->Session->setFlash("Veuillez spécifier la mention d'orientation de l'Autorité pour le traitement de ce courrier");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }
          else{
                  $d['total_Oriente_aavant'] = $this->Oriente->trouver_tout();

                  $this->Oriente->save(array(//on stock alors le ficher
                  'num_c'=>htmlspecialchars(strip_tags($this->request->data->num_c)),
                  'objet'=>htmlspecialchars(strip_tags($this->request->data->objet)), 
                  'nom_sign'=>htmlspecialchars(strip_tags($this->request->data->nom_sign)),
                  'date_rient'=>htmlspecialchars(strip_tags($this->request->data->date_rient)),
                  'num_phone_destina'=>htmlspecialchars(strip_tags($this->request->data->num_phone_destina)),
                  'Exploitant'=>htmlspecialchars(strip_tags($this->request->data->exploitant)),
                  'gouv_orient'=>htmlspecialchars(strip_tags($this->request->data->gouv_orient)),
                  'type'=>htmlspecialchars(strip_tags($this->request->data->type)),
                  'date_enre'=>date('d-m-Y'),
                  'heure_enre'=>date('H:i:s'),
                  'file'=>date('Y-m').'/'.$_FILES['file']['name']
                   ));
                  $d['total_Oriente_apres'] = $this->Oriente->trouver_tout();
                  if ($d['total_Oriente_apres']>$d['total_Oriente_avant']) {//si le nombre des Courriers entant, après enrégistrement n'est pas supérieur à celui d'avant, il y a eu donc echec d'enrégistrement, sinon, il y a eu nouveau enrégistrement
                          $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau courrier orienté dans le Serveur ");
                          $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                          exit;
                          }else{//si le nombre des users après enrégistrement n'est pas supérieur, il y a eu donc echec d'enrégistrement
                          $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité, créez un autre puis continuer *");
                          $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                          exit;
                          } 
               } 
          }else{//Fin test d'extension et d'enrégistrement
                  $this->Session->setFlash("l'extension de ce fichier n'est pas supportée par le notre serveur");
                  $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
                  }
      }else{//Fin $error==0
            $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
            $this->redirect('uploader/courriers_entrants_orientes/'.$this->Session->user('nom'));
            exit;
            }
  }//Fin request_data
}//Fin courriers_entrants_orientés
//============================================================================================
//=============================================================================================
function accuse_reception($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur','courrier_kin');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement des Accusés Reception, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                    $this->layout = 'gestion_acceuil';
                    $this->entrants();
                    $this->sortants();
                    $this->orientes();
                    $this->accuses();
                    $this->arret();
                    $this->total_reunion();
                    $this->discour();
                    $this->total_ordre_mission();
                    $this->total_com_affect();
                    $this->loadModel('Accuse');
                   //if ('adm'!=$this->Session->user('role')) {$this->redirect('users/login/');}
  
  if ($this->request->data && !empty($_FILES['file']['name'])) {
      
                    $name=$_FILES['file']['name']; 
      
                    $t_name=$_FILES['file']['tmp_name'];
      
                    $error=$_FILES['file']['error'];

       if($error===0){
        
                    $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
        
                    $ext_file = strtolower($ext);
        
                    $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
        
                    $dir = WEBROOT.DS.'accuses_reception'.DS.date('Y-m');//creéation du dossier de stockage $dir
        
                    if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre
        
        if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table
          move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader
          
          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                    $this->Session->setFlash("Pas de type de courriers vide, veuiller selectionner le type de courriers pour continuer");
                    $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                    $this->Session->setFlash("Chaque Courrier doit avoir un numéro, saisissez-en et continuer");
                    $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                    exit; 
                    } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                    $this->Session->setFlash("Désolé, Chaque courrier a un Son Signateur, veuillez en saisir pour continuer");
                    $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone_destina)))){
                    $this->Session->setFlash("Désolé, un numéro de téléphone est numérique, veuillez corriger et continuer");
                    $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                    $this->Session->setFlash("Vérifiez si l'objet a été saisi");
                    $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_reception)))||is_int(!htmlspecialchars(strip_tags($this->request->data->date_reception)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->date_reception)))){
                    $this->Session->setFlash("La date pose problème pour son identification");
                    $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_int(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->destinateur)))){
                    $this->Session->setFlash("Le nom du destinateur est important dans nos bases des données pour l'identification de nos accusés de reception");
                    $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                    exit; 
                    }
          else{
                    $d['total_Accuse_avant'] = $this->Accuse->trouver_tout();
                    $this->Accuse->save(array(//on stock
                    'num_c'=>htmlspecialchars(strip_tags($this->request->data->num_c)),
                    'objet'=>htmlspecialchars(strip_tags($this->request->data->objet)), 
                    'nom_sign'=>htmlspecialchars(strip_tags($this->request->data->nom_sign)),
                    'date_reception'=>htmlspecialchars(strip_tags($this->request->data->date_reception)),
                    'num_phone_destina'=>htmlspecialchars(strip_tags($this->request->data->num_phone_destina)),
                    'destinateur'=>htmlspecialchars(strip_tags($this->request->data->destinateur)), 
                    'type'=>htmlspecialchars(strip_tags($this->request->data->type)),
                    'date_enre'=>date('d-m-Y'),
                    'heure_enre'=>date('H:i:s'),
                    'file'=>date('Y-m').'/'.$_FILES['file']['name']
                     ));
                    $d['total_Accuse_apres'] = $this->Accuse->trouver_tout();
                    if ($d['total_Accuse_apres']>$d['total_Accuse_avant']) {//

                        $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau Accusé de réception dans le Serveur *");
                        $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                        exit;

                        }else{//
                              $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité, créez un autre puis continuer *");
                              $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
                              exit;
                              } 
                }


          }else{//Fin test d'extension et d'enrégistrement
               $this->Session->setFlash("l'extension de ce fichier n'est pas supportée par le notre serveur");
               $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
               exit;
               }
        
      }else{//Fin $error==0

            $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
            $this->redirect('uploader/accuse_reception/'.$this->Session->user('nom'));
            exit;

            }
  }//Fin request_data
}//Fin Accusé de reception
//============================================================================================

//=============================================================================================

function arretes($nom=null, $id=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement des Arrêtés, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                   $this->layout = 'gestion_acceuil';
                   $this->entrants();
                   $this->sortants();
                   $this->orientes();
                   $this->accuses();
                   $this->arret();
                   $this->total_reunion();
                   $this->discour();
                   $this->total_ordre_mission();
                   $this->total_com_affect();
                   $this->loadModel('Arrete');
  //if ('adm'!=$this->Session->user('role')) {$this->redirect('users/login/');}

  if ($this->request->data && !empty($_FILES['file']['name'])) {
 
                   $name=$_FILES['file']['name']; 
                   $t_name=$_FILES['file']['tmp_name'];
                   $error=$_FILES['file']['error'];
                   $size = $_FILES['file']['size'];


      if($error===0){

                   $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
                   $ext_file = strtolower($ext);
                   $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
                   $dir = WEBROOT.DS.'les_arrêtes'.DS.date('Y-m');//creéation du dossier de stockage $dir
                   if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre

        if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table
                  move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader
          
          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("Il faut définir le type d'arrêté qui a été signé pour continuer, merci");
                  $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_arret)))){
                  $this->Session->setFlash("Le Numéro de l'Arrêté ne peut-être vide ou a été mal saisi");
                  $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("Un Arrêté doit porter sur un objet bien défini");
                  $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Vous êtes prier d'insérer le nom du signataire de cet Arrêté svp, merci");
                  $this->redirect('gestionnaire/enre_membre_simple/'.$this->Session->user('nom'));
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_signat)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->date_signat)))){
                  $this->Session->setFlash("le format de votre date introduite est mauvais, veuillez recommencer svp");
                  $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
                  exit;  
                  }
          else{
                  $d['total_Arrete_avant'] = $this->Arrete->trouver_tout();
                  $this->Arrete->save(array(
                  'num_arret'=>htmlspecialchars(strip_tags($this->request->data->num_arret)),
                  'objet'=>htmlspecialchars(strip_tags($this->request->data->objet)), 
                  'nom_sign'=>htmlspecialchars(strip_tags($this->request->data->nom_sign)),
                  'date_signat'=>htmlspecialchars(strip_tags($this->request->data->date_signat)),
                  'type'=>htmlspecialchars(strip_tags($this->request->data->type)),
                  'date_enre'=>date('d-m-Y'),
                  'heure_enre'=>date('H:i:s'),
                  'file'=>date('Y-m').'/'.$_FILES['file']['name']
                  ));
                  $d['total_Arrete_apres'] = $this->Arrete->trouver_tout();
                  if ($d['total_Arrete_apres']>$d['total_Arrete_avant']) {//
                  $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau Arrêté dans le Serveur ");
                  $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
                  exit;
                  }else{//
                        $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité, créez un autre puis continuer *");
                        $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
                        exit;
                        }
              }

          }else{//Fin test d'extension et d'enrégistrement

               $this->Session->setFlash("l'extension de ce fichier n'est pas supportée par le notre serveur");
               $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
               exit;
               }
      }else{//Fin $error==0
            $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
            $this->redirect('uploader/arretes/'.$this->Session->user('nom'));
            exit;
            }
  }//Fin request_data
}//Fin Arrêté
//============================================================================================

function discours($id = null){

$mes_users = array('adm_principal');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement d'un Discours, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                  $this->layout = 'gestion_acceuil';
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->arret();
                  $this->total_reunion();
                  $this->discour();
                  $this->total_ordre_mission();
                  $this->total_com_affect();
                  $this->loadModel('Discour');

                  //if ('adm'!=$this->Session->user('role')) {$this->redirect('users/login/');}

  if ($this->request->data && !empty($_FILES['file']['name'])) {
                  $name=$_FILES['file']['name']; 
                  $t_name=$_FILES['file']['tmp_name'];
                  $error=$_FILES['file']['error'];
          if($error===0){
                  $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
                  $ext_file = strtolower($ext);
                  $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
                  $dir = WEBROOT.DS.'discours'.DS.date('Y-m');//creéation du dossier de stockage $dir
                  if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre

          if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table

                  move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader

          if (empty(htmlspecialchars(strip_tags($this->request->data->titre)))||is_int(htmlspecialchars(strip_tags($this->request->data->titre)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->titre)))){
                    $this->Session->setFlash("Pas de type de courriers vide, veuiller selectionner le type de courriers pour continuer");
                    $this->redirect('uploader/discours/'.$this->Session->user('nom'));
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->orateur)))){
                    $this->Session->setFlash("Chaque Courrier doit avoir un numéro, saisissez-en et continuer");
                    $this->redirect('uploader/discours/'.$this->Session->user('nom'));
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date)))||is_int(!htmlspecialchars(strip_tags($this->request->data->date)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->date)))){
                    $this->Session->setFlash("La date pose problème pour son identification");
                    $this->redirect('uploader/discours/'.$this->Session->user('nom'));
                    exit; 
                    }
          else{ 
                    $d['total_Discour_avant'] = $this->Discour->trouver_tout();

                    $this->Discour->save(array(
                    'date'=>htmlspecialchars(strip_tags($this->request->data->date)),
                    'titre'=>htmlspecialchars(strip_tags($this->request->data->titre)),
                    'orateur'=>htmlspecialchars(strip_tags($this->request->data->orateur)),
                    'date_enre'=>date('d-m-Y'),
                    'heure_enre'=>date('H:i:s'),
                    'file'=>date('Y-m').'/'.$_FILES['file']['name']
                     ));
                    $d['total_Discour_apres'] = $this->Discour->trouver_tout();
                    if ($d['total_Discour_apres']>$d['total_Discour_avant']) {//si le nombre des discours avant et supérieur de clui après enrégistrment, action russi
                    $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau Discours dans le Serveur *");
                    $this->redirect('uploader/discours/'.$this->Session->user('nom'));
                    exit;
                    }else{
                          $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité, créez un autre puis continuer *");
                          $this->redirect('uploader/discours/'.$this->Session->user('nom'));
                          exit;
                          }
                } 


          }else{//si l'extension du fichier ne figure pas 
                  $this->Session->setFlash("Désolé, l'extension de ce fichier n'est pas supportée par notre serveur *");
                  $this->redirect('uploader/discours/'.$this->Session->user('nom'));
                  }
        
      }else{////si erreur du fichier!=0 c'est que le pdf est de mauvaise qualité
                  $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
                  $this->redirect('uploader/discours/'.$this->Session->user('nom'));
                  exit;
                  }
  }//Fin request_data
}//Fin discours

//============================================================================================
function ordre_mission($id = null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement d'un Ordre de Mission, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                  $this->layout = 'gestion_acceuil';
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->arret();
                  $this->total_reunion();
                  $this->discour();
                  $this->total_ordre_mission();
                  $this->total_com_affect();
                  $this->loadModel('Ordres_mission');

                  //if ('adm'!=$this->Session->user('role')) {$this->redirect('users/login/');}
  if ($this->request->data && !empty($_FILES['file']['name'])) {
                  $name=$_FILES['file']['name']; 
                  $t_name=$_FILES['file']['tmp_name'];
                  $error=$_FILES['file']['error'];
                  //var_dump($_FILES);exit;
          if($error===0){
                  $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
                  $ext_file = strtolower($ext);
                  $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
                  $dir = WEBROOT.DS.'ordres_missions'.DS.date('Y-m');//creéation du dossier de stockage $dir
                  if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre

          if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table

                  move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader
          if (empty(htmlspecialchars(strip_tags($this->request->data->num)))){
                    $this->Session->setFlash("Veuillez entrer le numéro de cet Ordre de Mission pour continuer");
                    $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->destination)))){
                    $this->Session->setFlash("Veuillez entrer la destination pour cet Ordre de Mission pour continuer");
                    $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))){
                    $this->Session->setFlash("Veuillez entrer l'Objet de cet Ordre de Mission pour continuer");
                    $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                    exit; 
                    }
          if (empty(htmlspecialchars(strip_tags($this->request->data->nom_titulaire_mission)))){
                    $this->Session->setFlash("Veuillez entrer le nom du titulaire de cet Ordre de Mission pour continuer");
                    $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->fonction_titulaire_mission)))){
                    $this->Session->setFlash("Veuillez entrer la Fonction du Titulaire de cet Ordre de Mission pour continuer");
                    $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_signature)))){
                    $this->Session->setFlash("Veuillez entrer la date de signature de cet Ordre de Mission pour continuer");
                    $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                    exit; 
                    }
          else{ 
                    $d['total_Ordres_mission_avant'] = $this->Ordres_mission->trouver_tout();

                    $this->Ordres_mission->save(array(
                    'num'=>htmlspecialchars(strip_tags($this->request->data->num)),
                    'destination'=>htmlspecialchars(strip_tags($this->request->data->destination)),
                    'objet'=>htmlspecialchars(strip_tags($this->request->data->objet)),
                    'nom_titulaire_mission'=>htmlspecialchars(strip_tags($this->request->data->nom_titulaire_mission)),
                    'fonction_titulaire_mission'=>htmlspecialchars(strip_tags($this->request->data->fonction_titulaire_mission)),
                    'date_signature'=>htmlspecialchars(strip_tags($this->request->data->date_signature)),
                    'date_enr'=>date('d-m-Y'),
                    'heure_enr'=>date('H:i:s'),
                    'file'=>date('Y-m').'/'.$_FILES['file']['name']
                     ));
                    $d['total_Ordres_mission_apres'] = $this->Ordres_mission->trouver_tout();
                    if ($d['total_Ordres_mission_apres']>$d['total_Ordres_mission_avant']) {//si le nombre des discours avant et supérieur de clui après enrégistrment, action russi
                    $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau Discours dans le Serveur *");
                    $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                    exit;
                    }else{
                          $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité, créez un autre puis continuer *");
                          $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                          exit;
                          }
                } 


          }else{//si l'extension du fichier ne figure pas 
                  $this->Session->setFlash("Désolé, l'extension de ce fichier n'est pas supportée par notre serveur *");
                  $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                  }
        
      }else{////si erreur du fichier!=0 c'est que le pdf est de mauvaise qualité
                  $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
                  $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                  exit;
                  }
  }//Fin request_data
}//Fin ordre de mission
//============================================================================================
function comm_affectation($id = null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement d'une Commission d'Affectation, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                  $this->layout = 'gestion_acceuil';
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->arret();
                  $this->total_reunion();
                  $this->discour();
                  $this->total_ordre_mission();
                  $this->total_com_affect();
                  $this->loadModel('Comm_affectation');

  if ($this->request->data && !empty($_FILES['file']['name'])) {
                  $name=$_FILES['file']['name']; 
                  $t_name=$_FILES['file']['tmp_name'];
                  $error=$_FILES['file']['error'];

          if($error===0){
                  $ext=pathinfo($name, PATHINFO_EXTENSION);//on obtient l'extension du fichier
                  $ext_file = strtolower($ext);
                  $tab_ext = array('pdf');//voici notre tableau d'extension que doit avoir un fichier, sinon le fichier sera refusé
                  $dir = WEBROOT.DS.'commission_d_affectation'.DS.date('Y-m');//creéation du dossier de stockage $dir
                  if (!file_exists($dir)) mkdir($dir,0777);//on teste si le dossier $dir existe, sinon on en crée un autre

          if(in_array($ext_file, $tab_ext)){ //on vérifie si l'extension du fichier figure dans notre table

                  move_uploaded_file($t_name, $dir.DS.$name);//on charge alors l'image à uploader

                  if (empty(htmlspecialchars(strip_tags($this->request->data->num)))){
                            $this->Session->setFlash("Veuillez entrer le numéro de cette Commission pour continuer");
                            $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));
                            exit;  
                            }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->lieu_affectation)))){
                            $this->Session->setFlash("Veuillez entrer le lieux d'affectation de cette Commission pour continuer");
                            $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));
                            exit; 
                            }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->division)))){
                            $this->Session->setFlash("Veuillez entrer le nom de la division de cette Commission pour continuer");
                            $this->redirect('uploader/ordre_mission/'.$this->Session->user('nom'));
                            exit; 
                            }
                  if (empty(htmlspecialchars(strip_tags($this->request->data->Nom_personne_affect)))){
                            $this->Session->setFlash("Veuillez entrer le nom de la personne de cette Commission pour continuer");
                            $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));
                            exit;  
                            }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->fonction)))){
                            $this->Session->setFlash("Veuillez entrer la Fonction de la personne affectée de cette Commission pour continuer");
                            $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));
                            exit; 
                            }
                  else{ 
                            $d['total_Comm_affect_avant'] = $this->Comm_affectation->trouver_tout();

                            $this->Comm_affectation->save(array(
                            'num'=>htmlspecialchars(strip_tags($this->request->data->num)),
                            'lieu_affectation'=>htmlspecialchars(strip_tags($this->request->data->lieu_affectation)),
                            'division'=>htmlspecialchars(strip_tags($this->request->data->division)),
                            'Nom_personne_affect'=>htmlspecialchars(strip_tags($this->request->data->Nom_personne_affect)),
                            'fonction'=>htmlspecialchars(strip_tags($this->request->data->fonction)),
                            'date_signature'=>htmlspecialchars(strip_tags($this->request->data->date_signature)),
                            'date_enr'=>date('d-m-Y'),
                            'heure_enr'=>date('H:i:s'),
                            'file'=>date('Y-m').'/'.$_FILES['file']['name']
                             ));

                            $d['total_comm_affect_apres'] = $this->Comm_affectation->trouver_tout();

                            if ($d['total_comm_affect_apres']>$d['total_Comm_affect_avant']) {//si le nombre des discours avant et supérieur de clui après enrégistrment, action russi
                                    $this->Session->setFlash("Bravo! Vous venez d'enrégistrer une nouvelle Commission d'Affectation dans le Serveur *");
                                    $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));
                                    exit;
                                    }else{
                                          $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité, créez un autre puis continuer *");
                                          $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));
                                          exit;
                                          }
                        } 


          }else{//si l'extension du fichier ne figure pas 
                  $this->Session->setFlash("Désolé, l'extension de ce fichier n'est pas supportée par notre serveur *");
                  $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));                  }
        
      }else{////si erreur du fichier!=0 c'est que le pdf est de mauvaise qualité
                  $this->Session->setFlash("Ce fichier n'est pas supporté par le serveur");
                  $this->redirect('uploader/comm_affectation/'.$this->Session->user('nom'));                  exit;
                  }
  }//Fin request_data
}
//=======================================================================
//==============Enrégistrément de la réunion=========================================================
function reunion_uploader($id = null){

$mes_users = array('adm_principal','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement d'une Réunion, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas ou vous pouvez vous adressez auprès de la ParSec du Gouverneur. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->discour();
                 $this->total_ordre_mission();
                 $this->total_com_affect();
                 $this->loadModel('Reunion');
//if ('adm'!=$this->Session->user('role')) {$this->redirect('users/login/');}
  if ($this->request->data) {

            if (empty(htmlspecialchars(strip_tags($this->request->data->lieu_reunion)))||is_int(htmlspecialchars(strip_tags($this->request->data->lieu_reunion)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->lieu_reunion)))){
                  $this->Session->setFlash("Veuillez préciser le lieu où s'est tenue la réunion svp");
                  $this->redirect('uploader/reunion_uploader/'.$this->Session->user('nom'));
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->fonction)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->fonction)))){
                  $this->Session->setFlash("La Fonction du participant à la réunion est obligatoir pour continuer, Veuillez l'inscrire avant de continuer");
                  $this->redirect('uploader/reunion_uploader/'.$this->Session->user('nom'));
                  exit;  
                  }

            elseif (empty(htmlspecialchars(strip_tags($this->request->data->date)))||is_int(htmlspecialchars(strip_tags($this->request->data->date)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->date)))){
                  $this->Session->setFlash("le format date n'est pas supporté par notre serveur");
                  $this->redirect('uploader/reunion_uploader/'.$this->Session->user('nom'));
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("Vérifiez si l'objet de ce courrier a bel et bien été bien saisi, puis continuer");
                  $this->redirect('uploader/reunion_uploader/'.$this->Session->user('nom'));
                  exit;  
                  }
            else{
                  $d['total_Reunion_avant'] = $this->Reunion->trouver_tout();
                  
                  $this->Reunion->save(array(//on stock alors le ficher allant à l'image stocker
                  'lieu_reunion'=>htmlspecialchars(strip_tags($this->request->data->lieu_reunion)),
                  'fonction'=>htmlspecialchars(strip_tags($this->request->data->fonction)),
                  'date'=>htmlspecialchars(strip_tags($this->request->data->date)),
                  'objet'=>htmlspecialchars(strip_tags($this->request->data->objet)),
                  'date_enre'=>date('d-m-Y'),
                  'heure_enre'=>date('H:i:s'),
                  'cle_parent' => sha1(date('d-m-Y').date('H:i:s'))
                  ));
                  $d['total_Reunion_apres'] = $this->Reunion->trouver_tout();
                  if ($d['total_Reunion_apres']>$d['total_Reunion_avant']) {
                  $this->Session->setFlash("Bravo! Vous venez d'enrégistrer une nouvelle Réunion dans le Serveur *");
                  $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                  exit;
                  }else{//si le nombre des users après enrégistrement n'est pas supérieur, il y a eu donc echec d'enrégistrement
                  $this->Session->setFlash("Le fichier Pdf choisi est de mauvaise qualité, créez un autre puis continuer *");
                  $this->redirect('uploader/reunion_uploader/'.$this->Session->user('nom'));
                  exit;
                  }
                } 
  }
        
}
//=============================================================================================
function reunion_ajout_part($id=null){

$mes_users = array('adm_principal','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement d'un Nouveau Participant, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
     $this->layout = 'gestion_acceuil';
     $this->entrants();
     $this->sortants();
     $this->orientes();
     $this->accuses();
     $this->arret();
     $this->total_reunion();
     $this->discour();
     $this->total_ordre_mission();
     $this->total_com_affect();


if ($this->request->data){
            if (empty(htmlspecialchars(strip_tags($this->request->data->sexe)))||is_int(htmlspecialchars(strip_tags($this->request->data->sexe)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->sexe)))){
                  $this->Session->setFlash("Quel est le genre du participant ou de la participante?");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom)))){
                  $this->Session->setFlash("Le nom du participant à réunion est obligatoir pour continuer, Veuillez l'inscrire avant de continuer");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->post_nom)))||is_int(htmlspecialchars(strip_tags($this->request->data->post_nom)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->post_nom)))){
                  $this->Session->setFlash("Le Post-nom du participant à réunion est obligatoir pour continuer, Veuillez l'inscrire avant de continuer ou mettez son prénom");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->prenom)))||is_int(htmlspecialchars(strip_tags($this->request->data->prenom)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->prenom)))){
                  $this->Session->setFlash("Le Prénom du participant à réunion est obligatoir pour continuer, Veuillez l'inscrire avant de continuer");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->fonction)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->fonction)))){
                  $this->Session->setFlash("La Fonction du participant à la réunion est obligatoir pour continuer, Veuillez l'inscrire avant de continuer");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone)))||is_int(!htmlspecialchars(strip_tags($this->request->data->num_phone)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->num_phone)))){
                  $this->Session->setFlash("Chaque participant à la réunion qui a un numéro de téléphone, peut-être inscrit ici, comme point de contact");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->cle_parent)))||is_int(htmlspecialchars(strip_tags($this->request->data->cle_parent)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->cle_parent)))){
                  $this->Session->setFlash("le format date n'est pas supporté par notre serveur");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->e_mail)))||is_int(htmlspecialchars(strip_tags($this->request->data->e_mail)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->e_mail)))){
                  $this->Session->setFlash("Vérifiez si l'objet de ce courrier a bel et bien été bien saisi, puis continuer");
                  $this->redirect('uploader/reunion_uploader/'.$id);
                  exit;  
                  }
            else{
                  $this->loadModel('Reunion_ajout_part');
                  $d['total_Reunion_ajout_part_avant'] = $this->Reunion_ajout_part->trouver_tout();
                  $this->Reunion_ajout_part->save(array(

                  'objet_reunion'=>htmlspecialchars(strip_tags($this->request->data->objet_reunion)),
                  'sexe'=>htmlspecialchars(strip_tags($this->request->data->sexe)),
                  'nom'=>htmlspecialchars(strip_tags($this->request->data->nom)), 
                  'post_nom'=>htmlspecialchars(strip_tags($this->request->data->post_nom)),
                  'prenom'=>htmlspecialchars(strip_tags($this->request->data->prenom)),
                  'fonction'=>htmlspecialchars(strip_tags($this->request->data->fonction)),
                  'num_phone'=>htmlspecialchars(strip_tags($this->request->data->num_phone)),
                  'e_mail'=>htmlspecialchars(strip_tags($this->request->data->e_mail)),
                  'cle_parent'=>htmlspecialchars(strip_tags($this->request->data->cle_parent)),
                  'date_enr'=>date('d-m-Y'),
                  'heur_enr'=>date('H:i:s')
                  ));
                  $d['total_Reunion_ajout_part_apres'] = $this->Reunion_ajout_part->trouver_tout();
                  if ($d['total_Reunion_ajout_part_apres']>$d['total_Reunion_ajout_part_avant']) {
                  $this->Session->setFlash("Bravo! Vous venez d'enrégistrer un nouveau membre ayant participé à la réunion, dans le Serveur *");
                  $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                  exit;
                  }else{//si le nombre des users après enrégistrement n'est pas supérieur, il y a eu donc echec d'enrégistrement
                  $this->Session->setFlash("Une erreur de non uploader les infos est survenue *");
                  $this->redirect('uploader/presences_reunions/'.$this->Session->user('nom'));
                  exit;
                  }
                }
    }else{
    $cond = array('id'=>$id);
    $this->loadModel('Reunion');
    $d['reunion'] = $this->Reunion->find(array('conditions' => $cond));
    if (empty($d['reunion'])) { 
        $this->Session->setFlash("Erreur inattendu est survenue.");
        $this->redirect('printers/annuaire_reunion/');
        }
    return $this->set($d);
    }

}

//=======================================================================
//=======================================================================
function reunion_discussions($id = null){

$mes_users = array('adm_principal','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement d'une discussion liée à la réunion, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
    $this->layout = 'gestion_acceuil';
    $this->entrants();
    $this->sortants();
    $this->orientes();
    $this->accuses();
    $this->arret();
    $this->total_reunion();
    $this->discour();
    $this->total_ordre_mission();
    $this->total_com_affect();
if ($this->request->data){
                  if (empty(htmlspecialchars(strip_tags($this->request->data->points_discutes)))||is_int(htmlspecialchars(strip_tags($this->request->data->points_discutes)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->points_discutes)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des Points Discutés et des Faits Discutés, puis continuer");
                      $this->redirect('uploader/reunion_discussions/'.$this->request->data->id);
                      exit;
                  }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->faits_decisions)))||is_int(htmlspecialchars(strip_tags($this->request->data->faits_decisions)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->faits_decisions)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des Décisions Prises, puis continuer");
                      $this->redirect('uploader/reunion_discussions/'.$this->request->data->id);
                      exit;
                  }
                  else {
                  $this->loadModel('Reunion_discussion');
                  $d['total_avant'] = $this->Reunion_discussion->trouver_tout();
                  $this->Reunion_discussion->save(array(
                      'objet_reunion'=>htmlspecialchars(strip_tags($this->request->data->objet_reunion)),
                      'faits_discutes'=>htmlspecialchars(strip_tags($this->request->data->points_discutes)),
                      'faits_imports'=>htmlspecialchars(strip_tags($this->request->data->faits_decisions)),
                      'cle_parent'=>htmlspecialchars(strip_tags($this->request->data->cle_parent)),
                      'date_enr'=>date('d-m-Y'),
                      'heur_enr'=>date('H:i:s')
                      ));
                  $d['total__apres'] = $this->Reunion_discussion->trouver_tout();

                  if ($d['total__apres'] > $d['total_avant']) {
                  $this->Session->setFlash("Bravo! vous venez de résumer les discussions soulevées lors de la réunion, dans le Serveur *");
                  $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                  exit;
                  }else{//si le nombre des users après enrégistrement n'est pas supérieur, il y a eu donc echec d'enrégistrement
                  $this->Session->setFlash("Une erreur de non uploader des infos est survenue *");

                  $this->redirect('uploader/reunion_discussions/'.$this->request->data->id);
                  exit;
                  }
                  }

    
    }else{
    $cond = array('id'=>$id);
    $this->loadModel('Reunion');
    $d['reunions'] = $this->Reunion->find(array('conditions' => $cond));
    if (empty($d['reunions'])) { 
        $this->Session->setFlash("Erreur inattendue est survenue.");
        $this->redirect('printers/annuaire_reunion/');
        }
    return $this->set($d);
    }
}
//=======================================================================

function reunion_decisions_et_recommandations($id = null){

$mes_users = array('adm_principal','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement de Décision etRecommandation liées à la réunion, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
    $this->layout = 'gestion_acceuil';
    $this->entrants();
    $this->sortants();
    $this->orientes();
    $this->accuses();
    $this->arret();
    $this->total_reunion();
    $this->discour();
    $this->total_ordre_mission();
    $this->total_com_affect();

if ($this->request->data){
                  if (empty(htmlspecialchars(strip_tags($this->request->data->decisions)))||is_int(htmlspecialchars(strip_tags($this->request->data->decisions)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->decisions)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des decisions Prises, puis continuer");
                      $this->redirect('uploader/reunion_decisions_et_recommandations/'.$this->request->data->id);
                      exit;
                  }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->recommandations)))||is_int(htmlspecialchars(strip_tags($this->request->data->recommandations)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->recommandations)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des recommandations, puis continuer");
                      $this->redirect('uploader/reunion_decisions_et_recommandations/'.$this->request->data->id);
                      exit;
                  }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->actions_entreprendre)))||is_int(htmlspecialchars(strip_tags($this->request->data->actions_entreprendre)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->actions_entreprendre)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des recommandations, puis continuer");
                      $this->redirect('uploader/reunion_decisions_et_recommandations/'.$this->request->data->id);
                      exit;
                  }
                  else {
                  $this->loadModel('Reunion_decisions_recommandation');
                  $d['total_avant'] = $this->Reunion_decisions_recommandation->trouver_tout();
                  $this->Reunion_decisions_recommandation->save(array(
                      
                      'objet_reunion'=>htmlspecialchars(strip_tags($this->request->data->objet_reunion)),
                      'decisions_prises'=>htmlspecialchars(strip_tags($this->request->data->decisions)),
                      'recommandations'=>htmlspecialchars(strip_tags($this->request->data->recommandations)),
                      'actions_entreprendre'=>htmlspecialchars(strip_tags($this->request->data->actions_entreprendre)),
                      'cle_parent'=>htmlspecialchars(strip_tags($this->request->data->cle_parent)),
                      'date_enr'=>date('d-m-Y'),
                      'heur_enr'=>date('H:i:s')
                      ));
                  $d['total__apres'] = $this->Reunion_decisions_recommandation->trouver_tout();

                  if ($d['total__apres'] > $d['total_avant']) {
                  $this->Session->setFlash("Bravo! vous venez de rediger les Décisions prises, les Récommandations formulées et les Actions à entrprendre maintenues lors de cette réunion, dans le Serveur *");
                  $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                  exit;
                  }else{//si le nombre des users après enrégistrement n'est pas supérieur, il y a eu donc echec d'enrégistrement
                  $this->Session->setFlash("Une erreur de non uploader des infos est survenue *");

                  $this->redirect('uploader/reunion_decisions_et_recommandations/'.$this->request->data->id);
                  exit;
                  }
                  }

    
    }else{
    $cond = array('id'=>$id);
    $this->loadModel('Reunion');
    $d['reunions'] = $this->Reunion->find(array('conditions' => $cond));
    if (empty($d['reunions'])) { 
        $this->Session->setFlash("Erreur inattendue est survenue.");
        $this->redirect('printers/annuaire_reunion/');
        }
    return $this->set($d);
    }
}
//=======================================================================
function reunion_responsEcheances($id = null){

$mes_users = array('adm_principal','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement de Responsabilté liée à la réunion, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
    $this->layout = 'gestion_acceuil';
    $this->entrants();
    $this->sortants();
    $this->orientes();
    $this->accuses();
    $this->arret();
    $this->total_reunion();
    $this->discour();
    $this->total_ordre_mission();
    $this->total_com_affect();

if ($this->request->data){
                  if (empty(htmlspecialchars(strip_tags($this->request->data->responsabilites)))||is_int(htmlspecialchars(strip_tags($this->request->data->responsabilites)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->responsabilites)))) {
                      $this->Session->setFlash("Vérifiez Responsabilités établies, puis continuer");
                      $this->redirect('uploader/reunion_responsEcheances/'.$this->request->data->id);
                      exit;
                  }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->echeances)))||is_int(htmlspecialchars(strip_tags($this->request->data->echeances)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->echeances)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des Echanges, puis continuer");
                      $this->redirect('uploader/reunion_responsEcheances/'.$this->request->data->id);
                      exit;
                  }
                  else {
                  $this->loadModel('Echeance');
                  $d['total__apres'] = $this->Echeance->trouver_tout();
                  $this->Echeance->save(array(
                      
                      
                      'objet_reunion'=>htmlspecialchars(strip_tags($this->request->data->objet_reunion)),
                      'responsabilites'=>htmlspecialchars(strip_tags($this->request->data->responsabilites)),
                      'echeances'=>htmlspecialchars(strip_tags($this->request->data->echeances)),
                      'clef_parent'=>htmlspecialchars(strip_tags($this->request->data->cle_parent)),
                      'date_enr'=>date('d-m-Y'),
                      'heur_enr'=>date('H:i:s')
                      ));
                  $d['total__apres'] = $this->Echeance->trouver_tout();

                  if ($d['total__apres'] > $d['total_avant']) {
                  $this->Session->setFlash("Bravo! vous venez de rediger les échéances et les Récommandations formulées lors de cette réunion, dans le Serveur *");
                  $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                  exit;
                  }else{
                  $this->Session->setFlash("Une erreur de non uploader des infos est survenue *");

                  $this->redirect('uploader/reunion_responsEcheances/'.$this->request->data->id);
                  exit;
                  }
                  }

    }else{
    $cond = array('id'=>$id);
    $this->loadModel('Reunion');
    $d['reunions'] = $this->Reunion->find(array('conditions' => $cond));
    if (empty($d['reunions'])) { 
        $this->Session->setFlash("Erreur inattendue est survenue.");
        $this->redirect('printers/annuaire_reunion/');
        }
    return $this->set($d);
    }
}
//=======================================================================
function reunion_suivi($id = null){

$mes_users = array('adm_principal','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'enrégistrement du Suivi lié à la réunion, requiert de l'autorisation d'accès de l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
    $this->layout = 'gestion_acceuil';
    $this->entrants();
    $this->sortants();
    $this->orientes();
    $this->accuses();
    $this->arret();
    $this->total_reunion();
    $this->discour();
    $this->total_ordre_mission();
    $this->total_com_affect();
if ($this->request->data){
                  if (empty(htmlspecialchars(strip_tags($this->request->data->Prochaines_Etapes)))||is_int(htmlspecialchars(strip_tags($this->request->data->Prochaines_Etapes)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->Prochaines_Etapes)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des Prochaines Etapes Discutées, puis continuer");
                      $this->redirect('uploader/reunion_suivi/'.$this->request->data->id);
                      exit;
                  }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->prochaines_reunions)))||is_int(htmlspecialchars(strip_tags($this->request->data->prochaines_reunions)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->prochaines_reunions)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des prochaines reunions prévues, puis continuer");
                      $this->redirect('uploader/reunion_suivi/'.$this->request->data->id);
                      exit;
                  }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->Personnes_Charge_suivi)))||is_int(htmlspecialchars(strip_tags($this->request->data->Personnes_Charge_suivi)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->Personnes_Charge_suivi)))) {
                      $this->Session->setFlash("Vérifiez la rédaction des Personnes Chargées de suivi, puis continuer");
                      $this->redirect('uploader/reunion_suivi/'.$this->request->data->id);
                      exit;
                  }
                  else {
                  $this->loadModel('Suivi');
                  $d['total_avant'] = $this->Suivi->trouver_tout();
                  $this->Suivi->save(array(
                      
                      'objet_reunion'=>htmlspecialchars(strip_tags($this->request->data->objet_reunion)),
                      'Prochaines_Etapes'=>htmlspecialchars(strip_tags($this->request->data->Prochaines_Etapes)),
                      'prochaines_reunions'=>htmlspecialchars(strip_tags($this->request->data->prochaines_reunions)),
                      'Personnes_Charge_suivi'=>htmlspecialchars(strip_tags($this->request->data->Personnes_Charge_suivi)),
                      'cle_parent'=>htmlspecialchars(strip_tags($this->request->data->cle_parent)),
                      'date_enr'=>date('d-m-Y'),
                      'heur_enr'=>date('H:i:s')
                      ));
                  $d['total__apres'] = $this->Suivi->trouver_tout();

                  if ($d['total__apres'] > $d['total_avant']) {
                  $this->Session->setFlash("Bravo! vous venez de dresser:(1) Les Prochaines Etapes de cette Réunion; (2) Les Prochaines reunions de suivi et; (3) Vous vous avez établi les Personnes Chargées du suivi des programmes prévues et décités lors de la tenue de cette réunion. *");
                  $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                  exit;
                  }else{
                  $this->Session->setFlash("Une erreur de non uploader des infos est survenue *");

                  $this->redirect('uploader/reunion_suivi/'.$this->request->data->id);
                  exit;
                  }
                  }

    
    }else{
    $cond = array('id'=>$id);
    $this->loadModel('Reunion');
    $d['reunions'] = $this->Reunion->find(array('conditions' => $cond));
    if (empty($d['reunions'])) { 
        $this->Session->setFlash("Erreur inattendue est survenue.");
        $this->redirect('printers/annuaire_reunion/');
        }
    return $this->set($d);
    }
}


}//Fin class 