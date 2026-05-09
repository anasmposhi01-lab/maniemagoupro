<?php
class SearchersController extends Controller{

function entrant($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Entrant');
                 $d['end_file'] = $this->Entrant->dernier_enre(array());
                 //return $this->set($d);
                 
if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun numéro n'a été entré. Veuillez recommencer Merci");
                  $this->redirect('printers/annuaire_courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (!is_numeric(substr($objet_cherche, 0, 2))) {
                  $this->Session->setFlash("La Barre de recherche rapide n'est reservée qu'à faire une recherche avec le numéro du courrier et si vous n'en avez pas, veuillez aller faire vos recherches, en entrant vos données dans le formulaire se trouvant en bas de cette page (avec votre objet du courrier ou le nom de son Expéditeur. Merci");
                  $this->redirect('printers/annuaire_courriers_entrants/'.$this->Session->user('nom'));
                  exit;  
                  } 
          else{
                  $this->loadModel('Entrant');
                  $perPage = 8;
                  $condition = array('num_c' => $objet_cherche);
                  $d['entrants'] = $this->Entrant->find(array(
                  'fields' => `id,num_c, objet, nom_sign, date_expediteur, num_phone, expediteur, type, file`,
                  'conditions' => $condition,
                  'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                  $d['total_entrants'] = $this->Entrant->trouver_tout();
                  if (empty($d['entrants'])) { 

                    $this->Session->setFlash("Le Numéro du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche un bon numéro ou continuez dans le formulaire-recherche le plus élargie.");
                    $this->redirect('printers/annuaire_courriers_entrants/');

                  }
                  $d['page'] = ceil($d['total_entrants'] / $perPage);
                  return $this->set($d);
                  }
                }

if ($this->request->data) {
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='objet') {
                                      $this->loadModel('Entrant');
                                      $perPage = 8;
                                      $condition = array('objet' => $objet_cherche);
                                      $d['entrants']  = $this->Entrant->si_contient(array(
                                      'fields' => `id,num_c, objet, nom_sign, date_expediteur, num_phone, expediteur, type, file`,
                                      'conditions' => $condition,
                                      'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_entrants'] = $this->Entrant->trouver_tout();

                                      if (empty($d['entrants'])) { 
                                        $this->Session->setFlash("L'objet du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet objet.");
                                        $this->redirect('printers/annuaire_courriers_entrants/');
                                      }
                                      $d['page'] = ceil($d['total_entrants'] / $perPage);
                                       return $this->set($d);
                                       }

                 elseif ($mode==='num') {
                                      $this->loadModel('Entrant');
                                      $perPage = 8;
                                      $condition = array('num_c' => $objet_cherche);
                                      $d['entrants'] = $this->Entrant->find(array(
                                      'fields' => `id,num_c, objet, nom_sign, date_expediteur, num_phone, expediteur, type, file`,
                                      'conditions' => $condition,
                                      'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_entrants'] = $this->Entrant->trouver_tout();
                                      if (empty($d['entrants'])) { 

                                        $this->Session->setFlash("Le Numéro du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche un bon numéro et continuez.");
                                        $this->redirect('printers/annuaire_courriers_entrants/');

                                      }
                                      $d['page'] = ceil($d['total_entrants'] / $perPage);
                                      return $this->set($d);
                                      }
                 elseif ($mode==='exp') {
                                      $this->loadModel('Entrant');
                                      $perPage = 8;
                                      $condition = array('expediteur' => $objet_cherche);
                                      $d['entrants'] = $this->Entrant->si_contient(array(
                                      'fields' => `id,num_c, objet, nom_sign, date_expediteur, num_phone, expediteur, type, file`,
                                      'conditions' => $condition,
                                      'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_entrants'] = $this->Entrant->trouver_tout();
                                      if (empty($d['entrants'])) { 

                                        $this->Session->setFlash("Le nom de l'Expéditeur du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche Le bon nom de l'Expéditeur et continuez.");
                                        $this->redirect('printers/annuaire_courriers_entrants/');

                                      }
                                      $d['page'] = ceil($d['total_entrants'] / $perPage);
                                      return $this->set($d);
                                      } 
                  else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/annuaire_courriers_entrants/');
                       exit;
                      }              
 } 
}//fin fonction entrant  

//============================================================================================
function sortant($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Sortant');
                 $d['end_file'] = $this->Sortant->dernier_enre(array());
                 //return $this->set($d);
                 
if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun numéro n'a été entré. Veuillez recommencer Merci");
                  $this->redirect('printers/annuaire_courriers_sortants/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (!is_numeric(substr($objet_cherche, 0, 2))) {
                  $this->Session->setFlash("La Barre de recherche rapide n'est reservée qu'à faire une recherche avec le numéro du courrier et si vous n'en avez pas, veuillez aller faire vos recherches, en entrant vos données dans le formulaire se trouvant en bas de cette page (avec votre objet du courrier ou le nom de son Expéditeur. Merci");
                  $this->redirect('printers/annuaire_courriers_sortants/'.$this->Session->user('nom'));
                  exit;  
                  }
          else   {              
                  $this->loadModel('Sortant');
                  $condition = array('num_c' => $objet_cherche);
                  $perPage = 8;
                  $d['sortants'] = $this->Sortant->find(array(
                       'fields' => `id, num_c, objet, nom_sign, date_sign, num_phone, destinateur, type, file`,
                       'conditions' => $condition,
                       'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                  $d['total_sortants'] = $this->Sortant->trouver_tout();
                  $d['total_sortants'] = $this->Sortant->trouver_tout();
                  if (empty($d['sortants'])) { 

                    $this->Session->setFlash("Le numéro du Courrier cherché, n\'a pas été trouvé. Veuillez récommancer.");
                    $this->redirect('printers/annuaire_courriers_sortants/');

                  }
                  $d['page'] = ceil($d['total_sortants'] / $perPage);
                  return $this->set($d);
                  }
          }
if ($this->request->data) {
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='objet') {
                                      $this->loadModel('Sortant');
                                      $perPage = 8;
                                      $condition = array('objet' => $objet_cherche);
                                      $perPage = 8;
                                      $d['sortants'] = $this->Sortant->si_contient(array(
                                           'fields' => `id, num_c, objet, nom_sign, date_sign, num_phone, destinateur, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_sortants'] = $this->Sortant->trouver_tout();
                                      if (empty($d['sortants'])) { 

                                        $this->Session->setFlash("L'objet du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet objet.");
                                        $this->redirect('printers/annuaire_courriers_sortants/');

                                      }
                                      $d['page'] = ceil($d['total_sortants'] / $perPage);
                                      $this->set($d);
                                      }
                 elseif ($mode==='num') {
                                      $this->loadModel('Sortant');
                                      $condition = array('num_c' => $objet_cherche);
                                      $perPage = 8;
                                      $d['sortants'] = $this->Sortant->find(array(
                                           'fields' => `id, num_c, objet, nom_sign, date_sign, num_phone, destinateur, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_sortants'] = $this->Sortant->trouver_tout();
                                      $d['total_sortants'] = $this->Sortant->trouver_tout();
                                      if (empty($d['sortants'])) { 

                                        $this->Session->setFlash("Le numéro du Courrier cherché, n\'a pas été trouvé. Veuillez récommancer.");
                                        $this->redirect('printers/annuaire_courriers_sortants/');

                                      }
                                      $d['page'] = ceil($d['total_sortants'] / $perPage);
                                      return $this->set($d);
                                      }
                 elseif ($mode==='exp') {
                                      $this->loadModel('Sortant');
                                      $condition = array('destinateur' => $objet_cherche);
                                      $perPage = 8;
                                      $d['sortants'] = $this->Sortant->si_contient(array(
                                           'fields' => `id, num_c, objet, nom_sign, date_sign, num_phone, destinateur, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_sortants'] = $this->Sortant->trouver_tout();
                                      $d['total_sortants'] = $this->Sortant->trouver_tout();
                                      if (empty($d['sortants'])) { 

                                        $this->Session->setFlash("L\Expéditeur du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet Expéditeur.");
                                        $this->redirect('printers/annuaire_courriers_sortants/');

                                      }
                                      $d['page'] = ceil($d['total_sortants'] / $perPage);
                                      return $this->set($d);
                                      } 
                  else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/annuaire_courriers_sortants/');
                       exit;
                      }              
 } 
}//fin fonction sortant  

//============================================================================================
function oriente($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Oriente');
                 $d['end_file'] = $this->Oriente->dernier_enre(array());
                 //return $this->set($d);
                 
if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun numéro n'a été entré. Veuillez recommencer Merci");
                  $this->redirect('printers/annuaire_courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (!is_numeric(substr($objet_cherche, 0, 2))) {
                  $this->Session->setFlash("La Barre de recherche rapide n'est reservée qu'à faire une recherche avec le numéro du courrier et si vous n'en avez pas, veuillez aller faire vos recherches, en entrant vos données dans le formulaire se trouvant en bas de cette page (avec votre objet du courrier ou le nom de son Expéditeur. Merci");
                  $this->redirect('printers/annuaire_courriers_entrants_orientes/'.$this->Session->user('nom'));
                  exit;  
                  }                 
           else{  
                  $this->loadModel('Oriente');
                  $condition = array('num_c' => $objet_cherche);
                  $perPage = 8;
                  $d['orientes'] = $this->Oriente->find(array(
                       'fields' =>  `id, num_c, objet, nom_sign, date_rient, Exploitant, gouv_orient, type, file`,
                       'conditions' => $condition,
                       'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                  $d['total_orientes'] = $this->Oriente->trouver_tout();
                  $d['page'] = ceil($d['total_orientes'] / $perPage);
                  if (empty($d['orientes'])) { 

                    $this->Session->setFlash("Le Numéro du Courrier cherché, n\'a pas été trouvé. Veuillez Récommancer.");
                    $this->redirect('printers/annuaire_courriers_entrants_orientes/');

                  }
                  return $this->set($d);
                  }  
            }              
if ($this->request->data) {
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='objet') {
                                      $this->loadModel('Oriente');
                                      $condition = array('objet' => $objet_cherche);
                                      $perPage = 8;
                                      $d['orientes'] = $this->Oriente->si_contient(array(
                                           'fields' =>  `id, num_c, objet, nom_sign, date_rient, Exploitant, gouv_orient, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_orientes'] = $this->Oriente->trouver_tout();
                                      $d['page'] = ceil($d['total_orientes'] / $perPage);
                                      $d['total_sortants'] = $this->Sortant->trouver_tout();
                                      if (empty($d['orientes'])) { 

                                        $this->Session->setFlash("L'objet du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet objet.");
                                        $this->redirect('printers/annuaire_courriers_entrants_orientes/');

                                      }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='num') {
                                      $this->loadModel('Oriente');
                                      $condition = array('num_c' => $objet_cherche);
                                      $perPage = 8;
                                      $d['orientes'] = $this->Oriente->find(array(
                                           'fields' =>  `id, num_c, objet, nom_sign, date_rient, Exploitant, gouv_orient, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_orientes'] = $this->Oriente->trouver_tout();
                                      $d['page'] = ceil($d['total_orientes'] / $perPage);
                                      if (empty($d['orientes'])) { 

                                        $this->Session->setFlash("Le Numéro du Courrier cherché, n\'a pas été trouvé. Veuillez Récommancer.");
                                        $this->redirect('printers/annuaire_courriers_entrants_orientes/');

                                      }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='Exploitant') {
                                      $this->loadModel('Oriente');
                                      $condition = array('Exploitant' => $objet_cherche);
                                      $perPage = 8;
                                      $d['orientes'] = $this->Oriente->si_contient(array(
                                           'fields' =>  `id, num_c, objet, nom_sign, date_rient, Exploitant, gouv_orient, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_orientes'] = $this->Oriente->trouver_tout();
                                      $d['page'] = ceil($d['total_orientes'] / $perPage);
                                      if (empty($d['orientes'])) { 

                                        $this->Session->setFlash("L\Exploitant du Courrier cherché, n\'a pas été trouvé. Veuillez Récommancer.");
                                        $this->redirect('printers/annuaire_courriers_entrants_orientes/');

                                      }
                                      return $this->set($d);
                                      }
                 else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/annuaire_courriers_entrants_orientes/');
                       exit;
                      }              
 } 
}//fin fonction orientes  

//============================================================================================
function accuse_reception($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Accuse');
                 $d['end_file'] = $this->Accuse->dernier_enre(array());
                 //return $this->set($d);
                 
if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun numéro n'a été entré. Veuillez recommencer Merci");
                  $this->redirect('printers/annuaire_accuses_de_reception/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (!is_numeric(substr($objet_cherche, 0, 2))) {
                  $this->Session->setFlash("La Barre de recherche rapide n'est reservée qu'à faire une recherche avec le numéro du courrier et si vous n'en avez pas, veuillez aller faire vos recherches, en entrant vos données dans le formulaire se trouvant en bas de cette page (avec votre objet du courrier ou le nom de son Expéditeur. Merci");
                  $this->redirect('printers/annuaire_accuses_de_reception/'.$this->Session->user('nom'));
                  exit;  
                  }
          else{                 
                  $this->loadModel('Accuse');
                  $condition = array('num_c' => $objet_cherche);
                  $perPage = 8;
                  $d['accuses'] = $this->Accuse->find(array(
                       'fields' => `id, num_c, objet, nom_sign, date_reception, num_phone_destina, destinateur, type, file`,
                       'conditions' => $condition,
                       'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                  $d['total_accuses'] = $this->Accuse->trouver_tout();
                  $d['page'] = ceil($d['total_accuses'] / $perPage);
                  if (empty($d['accuses'])) { 

                    $this->Session->setFlash("Le Numéru du Courrier cherché, n\'a pas été trouvé. Veuillez Récommancer.");
                    $this->redirect('printers/annuaire_accuses_de_reception/');

                  }
                  return $this->set($d);
                 }
            }
if ($this->request->data) {
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='objet') {
                                      $this->loadModel('Accuse');
                                      $condition = array('objet' => $objet_cherche);
                                      $perPage = 8;
                                      $d['accuses'] = $this->Accuse->si_contient(array(
                                           'fields' => `id, num_c, objet, nom_sign, date_reception, num_phone_destina, destinateur, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_accuses'] = $this->Accuse->trouver_tout();
                                      $d['page'] = ceil($d['total_accuses'] / $perPage);
                                      if (empty($d['accuses'])) { 

                                        $this->Session->setFlash("L'objet du Courrier cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet objet.");
                                        $this->redirect('printers/annuaire_accuses_de_reception/');

                                      }
                                      return $this->set($d);
                                     }
                 elseif ($mode==='num') {
                                      $this->loadModel('Accuse');
                                      $condition = array('num_c' => $objet_cherche);
                                      $perPage = 8;
                                      $d['accuses'] = $this->Accuse->find(array(
                                           'fields' => `id, num_c, objet, nom_sign, date_reception, num_phone_destina, destinateur, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_accuses'] = $this->Accuse->trouver_tout();
                                      $d['page'] = ceil($d['total_accuses'] / $perPage);
                                      if (empty($d['accuses'])) { 

                                        $this->Session->setFlash("Le Numéru du Courrier cherché, n\'a pas été trouvé. Veuillez Récommancer.");
                                        $this->redirect('printers/annuaire_accuses_de_reception/');

                                      }
                                      return $this->set($d);
                                     }
                 elseif ($mode==='destinateur') {
                                      $this->loadModel('Accuse');
                                      $condition = array('destinateur' => $objet_cherche);
                                      $perPage = 8;
                                      $d['accuses'] = $this->Accuse->si_contient(array(
                                           'fields' => `id, num_c, objet, nom_sign, date_reception, num_phone_destina, destinateur, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      if (empty($d['accuses'])) { 

                                        $this->Session->setFlash("Le destinateur du Courrier cherché, n\'a pas été trouvé. Veuillez être bref en faisant vos recherches avec de mot courts et précis..");
                                        $this->redirect('printers/annuaire_accuses_de_reception/');

                                      }
                                      $d['total_accuses'] = $this->Accuse->trouver_tout();
                                      $d['page'] = ceil($d['total_accuses'] / $perPage);
                                      return $this->set($d);
                                     }
                   else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/annuaire_accuses_de_reception/');
                       exit;
                      }              
 } 
}//fin fonction accuse_reception  

//============================================================================================
function arretes($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Arrete');
                 $d['end_file'] = $this->Arrete->dernier_enre(array());
                 //return $this->set($d);
if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun numéro Arrêté n'a été entré. Veuillez recommencer Merci");
                  $this->redirect('printers/annuaire_arretes/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (!is_numeric(substr($objet_cherche, 0, 2))) {
                  $this->Session->setFlash("La Barre de recherche rapide n'est reservée qu'à faire une recherche avec le numéro de l'arrêté si vous en avez et si vous n'en avez pas, veuillez aller faire vos recherches dans le formulaire se trouvant en bas de cette page (avec votre objet l'Arrêté. Merci");
                  $this->redirect('printers/annuaire_arretes/'.$this->Session->user('nom'));
                  exit;  
                  } 
          else{                
                  $this->loadModel('Arrete');
                  $condition = array('num_arret' => $objet_cherche);
                  $perPage = 8;
                  $d['arret'] = $this->Arrete->find(array(
                       'fields' => `id, num_arret, objet, nom_sign, date_signat, type, file`,
                       'conditions' => $condition,
                       'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                  $d['total_arret'] = $this->Arrete->trouver_tout();
                  $d['page'] = ceil($d['total_arret'] / $perPage);
                  if (empty($d['arret'])) { 

                    $this->Session->setFlash("Le Numéro de l'\Arrêté cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet objet.");
                    $this->redirect('printers/annuaire_arretes/');

                  }
                  return $this->set($d);
                  }
              }
if ($this->request->data) {
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

               if ($mode==='objet') {
                                     $this->loadModel('Arrete');
                                      $condition = array('objet' => $objet_cherche);
                                      $perPage = 8;
                                      $d['arret'] = $this->Arrete->si_contient(array(
                                           'fields' => `id, num_arret, objet, nom_sign, date_signat, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_arret'] = $this->Arrete->trouver_tout();
                                      $d['page'] = ceil($d['total_arret'] / $perPage);
                                      if (empty($d['arret'])) { 

                                        $this->Session->setFlash("L'objet de l\Arrêté cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet objet.");
                                        $this->redirect('printers/annuaire_arretes/');

                                      }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='num_arret') {
                                      $this->loadModel('Arrete');
                                      $condition = array('num_arret' => $objet_cherche);
                                      $perPage = 8;
                                      $d['arret'] = $this->Arrete->find(array(
                                           'fields' => `id, num_arret, objet, nom_sign, date_signat, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      $d['total_arret'] = $this->Arrete->trouver_tout();
                                      $d['page'] = ceil($d['total_arret'] / $perPage);
                                      if (empty($d['arret'])) { 

                                        $this->Session->setFlash("Le Numéro de l'\Arrêté cherché, n\'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mot clé de cet objet.");
                                        $this->redirect('printers/annuaire_arretes/');

                                      }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='nom_sign') {
                                      $this->loadModel('Arrete');
                                      $condition = array('nom_sign' => $objet_cherche);
                                      $perPage = 8;
                                      $d['arret'] = $this->Arrete->si_contient(array(
                                           'fields' => `id, num_arret, objet, nom_sign, date_signat, type, file`,
                                           'conditions' => $condition,
                                           'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                      if (empty($d['arret'])) { 

                                        $this->Session->setFlash("Le Nom du Signateur de l\Arrêté cherché, n\'a pas été trouvé. Veuillez réessayer.");
                                        $this->redirect('printers/annuaire_arretes/');

                                      }
                                      $d['total_arret'] = $this->Arrete->trouver_tout();
                                      $d['page'] = ceil($d['total_arret'] / $perPage);
                                      return $this->set($d);
                                      } 
                    else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/annuaire_arretes/');
                       exit;
                      }              
 } 
}//fin fonction arretes  

//============================================================================================
function reunions(){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 
if ($this->request->data) {
  //var_dump($_POST);exit;
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='objet') {
                              if (empty(htmlspecialchars(strip_tags($objet_cherche)))||is_int(htmlspecialchars(strip_tags($objet_cherche)))||is_numeric(htmlspecialchars(strip_tags($objet_cherche)))){
                                        $this->Session->setFlash("le Titre de la Réunion ne peut-être vide ou un numéro. Veuillez entrer le titre et continuer");
                                        $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                                        exit;  
                                        }
                              else{
                                       $this->loadModel('Reunion');
                                       $condition = array('objet' => $objet_cherche);
                                       $perPage = 8;
                                       $d['reunion'] = $this->Reunion->si_contient(array(
                                            'fields' => `id, lieu_reunion, nom, post_nom, prenom, fonction, num_phone, e_mail, date, objet, president_reunion, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_reunion'] = $this->Reunion->trouver_tout();
                                       $d['page'] = ceil($d['total_reunion'] / $perPage);
                                      if (empty($d['reunion'])) { 
                                        $this->Session->setFlash("L'objet de la Réunion cherché, n\'a pas été trouvé.");
                                        $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                                      }
                                       return $this->set($d);
                                  }
                                }
                 else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/annuaire_reunion/'.$this->Session->user('nom'));
                       exit;
                      }              
 } 
}//fin fonction reunions  
//===========================================================================================
//============================================================================================
function discours($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Discour');
                 $d['end_file'] = $this->Discour->dernier_enre(array());
                 //return $this->set($d);

if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun Objet ou thème du discours n'a été entré. Veuillez recommencer Merci");
                  $this->redirect('printers/discours/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (is_numeric($objet_cherche)) {
                  $this->Session->setFlash("Le thème ou titre du discours ne peut-être numérique. Merci");
                  $this->redirect('printers/discours/'.$this->Session->user('nom'));
                  exit;  
                  }
          else{                 
                 $this->loadModel('Discour');
                 $condition = array('titre' => $objet_cherche);
                 $perPage = 8;
                 $d['discours'] = $this->Discour->si_contient(array(
                      'fields' => `id, titre, date, orateur, file`,
                      'conditions' => $condition,
                      'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                 $d['total_discours'] = $this->Discour->trouver_tout();
                 $d['page'] = ceil($d['total_discours'] / $perPage);
                if (empty($d['discours'])) { 

                $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                $this->redirect('printers/discours/');

                }
                 return $this->set($d);
                }
            }
if ($this->request->data) {
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='titre') {
                                       $this->loadModel('Discour');
                                       $condition = array('titre' => $objet_cherche);
                                       $perPage = 8;
                                       $d['discours'] = $this->Discour->si_contient(array(
                                            'fields' => `id, titre, date, orateur, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_discours'] = $this->Discour->trouver_tout();
                                       $d['page'] = ceil($d['total_discours'] / $perPage);
                                      if (empty($d['discours'])) { 

                                      $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                      $this->redirect('printers/discours/');

                                      }
                                       return $this->set($d);
                                      }
                 elseif ($mode==='date') {
                                       $this->loadModel('Discour');
                                       $this->layout = 'gestion_acceuil';
                                       $condition = array('date' => $objet_cherche);
                                       $perPage = 8;
                                       $d['discours'] = $this->Discour->si_contient(array(
                                            'fields' => `id, titre, date, orateur, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_discours'] = $this->Discour->trouver_tout();
                                       $d['page'] = ceil($d['total_discours'] / $perPage);
                                      if (empty($d['discours'])) { 

                                        $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                        $this->redirect('printers/discours/');

                                      }
                                       return $this->set($d);
                                      }
                 elseif ($mode==='orateur') {
                                       
                                       $this->loadModel('Discour');
                                       $condition = array('orateur' => $objet_cherche);
                                       $perPage = 8;
                                       $d['discours'] = $this->Discour->si_contient(array(
                                            'fields' => `id, titre, date, orateur, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_discours'] = $this->Discour->trouver_tout();
                                       $d['page'] = ceil($d['total_discours'] / $perPage);
                                      if (empty($d['discours'])) { 
                                        $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                        $this->redirect('printers/discours/');

                                      }
                                       return $this->set($d);
                                      }
                 else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/discours/');
                       exit;
                      }              
 } 
}//fin fonction discours  
//===========================================================================================

function ordre_mission($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Ordres_Mission');
                 $d['end_file'] = $this->Ordres_mission->dernier_enre(array());
                 //return $this->set($d);

if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun numéro de l'Ordre de Mission cherché n'a été entré. Veuillez entrer le numéro de l'Ordre de Mission voulu et continuer Merci");
                  $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (!is_numeric(substr($objet_cherche, 0, 2))) {
                  $this->Session->setFlash("La Barre de recherche rapide n'est reservée qu'à faire une recherche avec le numéro de votre Ordre de Mission,  si vous n'en avez pas, veuillez aller faire vos recherches dans le formulaire se trouvant en bas de cette page . Merci");
                  $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                  exit;  
                  } 
          else{                
                  $this->loadModel('Ordres_mission');
                  $condition = array('num' => $objet_cherche);
                  $perPage = 8;
                  $d['OR'] = $this->Ordres_mission->find(array(
                       'fields' => `id, num, destination, objet, nom_titulaire_mission, fonction_titulaire_mission, date_signature, date_enr, heure_enr, file`,
                       'conditions' => $condition,
                       'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                  $d['total_OR'] = $this->Ordres_mission->trouver_tout();
                  $d['page'] = ceil($d['total_OR'] / $perPage);
                  if (empty($d['OR'])) { 

                                      $this->Session->setFlash("Le Numéro de l'Ordre de Mission cherché, n'a pas été trouvé. Veuillez introduire dans la barre de recherche des Mots clé.");
                                      $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                                      exit;
                                      }
                return $this->set($d);
                }
              }
if ($this->request->data) {
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='num') {
                                       $this->loadModel('Ordres_mission');
                                       $condition = array('num' => $objet_cherche);
                                       $perPage = 8;
                                       $d['OR'] = $this->Ordres_mission->si_contient(array(
                                            'fields' => `id, num, destination, objet, nom_titulaire_mission, fonction_titulaire_mission, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_OR'] = $this->Ordres_mission->trouver_tout();
                                       $d['page'] = ceil($d['total_OR'] / $perPage);
                                      if (empty($d['OR'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='objet') {
                                       $this->loadModel('Ordres_mission');
                                       $this->layout = 'gestion_acceuil';
                                       $condition = array('objet' => $objet_cherche);
                                       $perPage = 8;
                                       $d['OR'] = $this->Ordres_mission->si_contient(array(
                                            'fields' => `id, num, destination, objet, nom_titulaire_mission, fonction_titulaire_mission, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_OR'] = $this->Ordres_mission->trouver_tout();
                                       $d['page'] = ceil($d['total_OR'] / $perPage);
                                      if (empty($d['OR'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='nom_titulaire_mission') {
                                       
                                       $this->loadModel('Ordres_mission');
                                       $condition = array('nom_titulaire_mission' => $objet_cherche);
                                       $perPage = 8;
                                       $d['OR'] = $this->Ordres_mission->si_contient(array(
                                            'fields' => `id, num, destination, objet, nom_titulaire_mission, fonction_titulaire_mission, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_OR'] = $this->Ordres_mission->trouver_tout();
                                       $d['page'] = ceil($d['total_OR'] / $perPage);
                                      if (empty($d['OR'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='fonction_titulaire_mission') {
                                       
                                       $this->loadModel('Ordres_mission');
                                       $condition = array('fonction_titulaire_mission' => $objet_cherche);
                                       $perPage = 8;
                                       $d['OR'] = $this->Ordres_mission->si_contient(array(
                                            'fields' => `id, num, destination, objet, nom_titulaire_mission, fonction_titulaire_mission, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_OR'] = $this->Ordres_mission->trouver_tout();
                                       $d['page'] = ceil($d['total_OR'] / $perPage);
                                      if (empty($d['OR'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 else{
                       $this->Session->setFlash('Mode de recherche choisi est inconu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                       exit;
                      }              
 } 
}
//===========================================================================================

function comm_affect($id=null){

                 $this->layout = 'gestion_acceuil';
                 $this->entrants();
                 $this->sortants();
                 $this->orientes();
                 $this->accuses();
                 $this->arret();
                 $this->total_reunion();
                 $this->total_ordre_mission();;
                 $this->discour();
                 $this->total_com_affect();
                 $this->loadModel('Comm_affectation');
                 $d['end_file'] = $this->Comm_affectation->dernier_enre(array());
                 //return $this->set($d);
if ($id==='1') {
          $objet_cherche = htmlspecialchars(strip_tags($this->request->data->objet_1)); 
 
          if (empty(htmlspecialchars(strip_tags($objet_cherche)))){
                  $this->Session->setFlash("Aucun numéro de la Commussion d'affectation n'a été entré. Veuillez entrer le numéro  et continuer Merci");
                  $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                  exit;  
                  }  
          elseif (!is_numeric(substr($objet_cherche, 0, 2))) {
                  $this->Session->setFlash("La Barre de recherche rapide n'est reservée qu'à faire une recherche avec le numéro de votre Commission que vous voulez trouver,  si vous n'en avez pas, veuillez aller faire vos recherches dans le formulaire se trouvant en bas de cette page . Merci");
                  $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                  exit;  
                  } 
          else{                
                  $this->loadModel('Comm_affectation');
                  $condition = array('num' => $objet_cherche);
                  $perPage = 8;
                  $d['com_affect'] = $this->Comm_affectation->find(array(
                       'fields' => `id, num, lieu_affectation, division, Nom_personne_affect, fonction, date_signature, date_enr, heure_enr, file`,
                       'conditions' => $condition,
                       'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                  $d['total_com_affect'] = $this->Comm_affectation->trouver_tout();
                  $d['page'] = ceil($d['total_com_affect'] / $perPage);
                  if (empty($d['com_affect'])) { 

                                      $this->Session->setFlash("Aucune Commission d'affectation, n'a pas été trouvé avec ce numéro $objet_cherche saisi. Veuillez introduire dans la barre de recherche pour une recherche avancée.");
                                      $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                                      exit;
                                      }
                return $this->set($d);
                }
              }
if ($this->request->data) {
  
                 $data = $this->request->data;
                 $mode = htmlspecialchars(strip_tags($data->mode));
                 $objet_cherche = htmlspecialchars(strip_tags($data->objet_1));

                 if ($mode==='num') {
                                       $this->loadModel('Comm_affectation');
                                       $condition = array('num' => $objet_cherche);
                                       $perPage = 8;
                                       $d['com_affect'] = $this->Comm_affectation->si_contient(array(
                                            'fields' => `id, num, lieu_affectation, division, Nom_personne_affect, fonction, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_com_affect'] = $this->Comm_affectation->trouver_tout();
                                       $d['page'] = ceil($d['total_com_affect'] / $perPage);
                                      if (empty($d['com_affect'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='division') {
                                       $this->loadModel('Comm_affectation');
                                       $this->layout = 'gestion_acceuil';
                                       $condition = array('division' => $objet_cherche);
                                       $perPage = 8;
                                       $d['com_affect'] = $this->Comm_affectation->si_contient(array(
                                            'fields' => `id, num, lieu_affectation, division, Nom_personne_affect, fonction, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_com_affect'] = $this->Comm_affectation->trouver_tout();
                                       $d['page'] = ceil($d['total_com_affect'] / $perPage);
                                      if (empty($d['com_affect'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='Nom_personne_affect') {
                                       
                                       $this->loadModel('Comm_affectation');
                                       $condition = array('nom_titulaire_mission' => $objet_cherche);
                                       $perPage = 8;
                                       $d['comm_affect'] = $this->Comm_affectation->si_contient(array(
                                            'fields' => `id, num, lieu_affectation, division, Nom_personne_affect, fonction, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_comm_affect'] = $this->Comm_affectation->trouver_tout();
                                       $d['page'] = ceil($d['total_comm_affect'] / $perPage);
                                      if (empty($d['comm_affect'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 elseif ($mode==='fonction') {
                                       
                                       $this->loadModel('Comm_affectation');
                                       $condition = array('fonction' => $objet_cherche);
                                       $perPage = 8;
                                       $d['comm_affect'] = $this->Comm_affectation->si_contient(array(
                                            'fields' => `id, num, lieu_affectation, division, Nom_personne_affect, fonction, date_signature, date_enr, heure_enr, file`,
                                            'conditions' => $condition,
                                            'limit' => ($this->request->page-1)*$perPage.','.$perPage));
                                       $d['total_comm_affect'] = $this->Comm_affectation->trouver_tout();
                                       $d['page'] = ceil($d['total_comm_affect'] / $perPage);
                                      if (empty($d['comm_affect'])) { 
                                                            $this->Session->setFlash("Aucune réponse ne correspond à votre demande, veuillez recommencer.");
                                                            $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                                                            exit;
                                                            }
                                      return $this->set($d);
                                      }
                 else{
                       $this->Session->setFlash('Mode de recherche choisi est inconnu par notre serveur, veuillez recommencer');
                       $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                       exit;
                      }              
 } 
}
//===========================================================================================
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
//============================================================================================
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
function total_ordre_mission($nom_user=null){
$this->loadModel('Ordres_mission');
$d['total_OR'] = $this->Ordres_mission->trouver_tout();
return $this->set($d);
}
//===========================================================================================
//===========================================================================================
function total_com_affect($nom_user=null){
    $this->loadModel('Comm_affectation');
               $d['total_comm_affect'] = $this->Comm_affectation->trouver_tout();
  return $this->set($d);
}
//============================================================================================


//============================================================================================

}//fin class