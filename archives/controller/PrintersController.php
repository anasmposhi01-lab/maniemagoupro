<?php
class PrintersController extends Controller{
/*
mermet la connexion des users de notre application
*/
function annuaire_courriers_entrants($nom_user=null){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("L'accès à l'annuaire des Courriers Entrants, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->sortants();
$this->orientes();
$this->accuses();
$this->arret();
$this->total_reunion();
$this->total_ordre_mission();
$this->discour();
$this->total_com_affect();
$this->layout = 'gestion_acceuil';
$this->loadModel('Entrant');
     $perPage = 8;
     $d['entrants'] = $this->Entrant->find(array(
          'fields' => `id,num_c, objet, nom_sign, date_expediteur, num_phone, expediteur, type, date_enre, heure_enre, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['total_entrants'] = $this->Entrant->trouver_tout();
     $d['end_file'] = $this->Entrant->dernier_enre(array());
     $d['page'] = ceil($d['total_entrants'] / $perPage);
return $this->set($d);
}
//============================================'adm_principal','Assistant_Principal','ops_1','ops_2','gouverneur','Parsec','courrier_kin'================================================
function annuaire_courriers_sortants($nom_user=null){ 

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');

if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Courriers Sortants, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->orientes();
$this->accuses();
$this->arret();
$this->total_reunion();
$this->total_ordre_mission();
$this->discour();
$this->total_com_affect();
$this->layout = 'gestion_acceuil';
$this->loadModel('Sortant');
     $perPage = 8;
     $d['sortants'] = $this->Sortant->find(array(
          'fields' => `id, num_c, objet, nom_sign, date_sign, num_phone, destinateur, type, date_enre, heure_enre, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['total_sortants'] = $this->Sortant->trouver_tout();
     $d['end_file'] = $this->Sortant->dernier_enre(array());
     $d['page'] = ceil($d['total_sortants'] / $perPage);
return $this->set($d);
}

//============================================================================================
function annuaire_courriers_entrants_orientes($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Courriers Entrant et Orientés, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->sortants();
$this->accuses();
$this->arret();
$this->total_reunion();
$this->total_ordre_mission();
$this->discour();
$this->total_com_affect();
$this->layout = 'gestion_acceuil';
$this->loadModel('Oriente');
     $perPage = 8;
     $d['orientes'] = $this->Oriente->find(array(
          'fields' =>  `id, num_c, objet, nom_sign, date_rient, Exploitant, gouv_orient, type, date_enre, heure_enre, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['total_orientes'] = $this->Oriente->trouver_tout();
     $d['end_file'] = $this->Oriente->dernier_enre(array());
     $d['page'] = ceil($d['total_orientes'] / $perPage);
     return $this->set($d);
}

//============================================================================================
function annuaire_accuses_de_reception($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur','courrier_kin');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Accusés Reception, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->sortants();
$this->orientes();
$this->arret();
$this->total_reunion();
$this->total_ordre_mission();
$this->discour();
$this->total_com_affect();
$this->layout = 'gestion_acceuil';
$this->loadModel('Accuse');
     $perPage = 8;
     $d['accuses'] = $this->Accuse->find(array(
          'fields' => `id, num_c, objet, nom_sign, date_reception, num_phone_destina, destinateur, type, date_enre, heure_enre, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['total_accuses'] = $this->Accuse->trouver_tout();
     $d['end_file'] = $this->Accuse->dernier_enre(array());
     $d['page'] = ceil($d['total_accuses'] / $perPage);
     return $this->set($d);
}
//============================================================================================
function annuaire_arretes($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Arrêtés du Gouvernement Provincial du Maniema, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->sortants();
$this->orientes();
$this->accuses();
$this->total_reunion();
$this->total_ordre_mission();
$this->discour();
$this->total_com_affect();
$this->layout = 'gestion_acceuil';
$this->loadModel('Arrete');
     $perPage = 8;
     $d['arret'] = $this->Arrete->find(array(
          'fields' => `id, num_arret, objet, nom_sign, date_signat, date_enre, heure_enre, type, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['total_arret'] = $this->Arrete->trouver_tout();
     $d['end_file'] = $this->Arrete->dernier_enre(array());
     $d['page'] = ceil($d['total_arret'] / $perPage);
     return $this->set($d);
}
//============================================================================================
function annuaire_reunion($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Réunions du Gouvernement Provincial du Maniema, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur, à la ParSec de Son Excellence Monsieur le Gouverneur ou enfin, à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->layout = 'gestion_acceuil';
//----------------------------------------
$this->entrants();
$this->sortants();
$this->orientes();
$this->accuses();
$this->arret();
$this->total_reunion();
$this->discour();
$this->total_com_affect();
$this->total_ordre_mission();
//-------------------------------------------
$this->loadModel('Reunion');
//----------------------------------------------
     $perPage = 8;
     $d['reunion'] = $this->Reunion->find(array(
          'fields' => `id, lieu_reunion, fonction, date, objet, date_enre, heure_enre, cle_parent`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
//=============================================
     foreach ($d['reunion'] as $k=>$v){
//-----------------------------------
     $d['total_reunion'] = $this->Reunion->trouver_tout();
     $d['page'] = ceil($d['total_reunion'] / $perPage);
     return $this->set($d);
     }
}

//============================================================================================
function annuaire_rapport_reunion($id){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur','Parsec');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès au Rapport de cette Réunion du Gouvernement Provincial du Maniema, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur, à la ParSec de Son Excellence Monsieur le Gouverneur ou enfin, à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->layout = 'gestion_acceuil';
//----------------------------------------
//-------------------------------------------
$this->loadModel('Reunion');
$this->loadModel('Reunion_discussion');
$this->loadModel('Reunion_decisions_recommandation');
$this->loadModel('Echeance');
$this->loadModel('Suivi');
$this->loadModel('Reunion_ajout_part');
$this->loadModel('Poubelle');
//----------------------------------------------

          $d['reunion'] = $this->Reunion->findfirst(array('conditions' => array('id'=>$id)));
          
          $objet = $d['reunion']->objet;
          $cle_primaire = $d['reunion']->cle_parent;
//=============================================

          $d['discution'] = $this->Reunion_discussion->findfirst(array('conditions' => array('cle_parent'=>$cle_primaire,'objet_reunion'=>$objet)));
          if (empty($d['discution'])) {
               $cond = array('id' => 1);
               $d['discution']  = $this->Poubelle->findfirst(array('conditions' => $cond));
          }
          $d['recommandation'] = $this->Reunion_decisions_recommandation->findfirst(array('conditions' => array('cle_parent'=>$cle_primaire,'objet_reunion'=>$objet)));
          if (empty($d['recommandation'])) {
               $cond = array('id' => 1);
               $d['recommandation']  = $this->Poubelle->findfirst(array('conditions' => $cond));
          }
          $d['echeances_ren'] = $this->Echeance->findfirst(array('conditions' => array('clef_parent'=>$cle_primaire,'objet_reunion'=>$objet)));
          if (empty($d['echeances_ren'])) {
               $cond = array('id' => 1);
               $d['echeances_ren']  = $this->Poubelle->findfirst(array('conditions' => $cond));
          }
          
          $d['les_suivis'] = $this->Suivi->findfirst(array('conditions' => array('cle_parent'=>$cle_primaire,'objet_reunion'=>$objet)));
          if (empty($d['les_suivis'])) {
               $cond = array('id' => 1);
               $d['les_suivis']  = $this->Poubelle->findfirst(array('conditions' => $cond));
          }
          $d['les_participants'] = $this->Reunion_ajout_part->findfirst(array('conditions' => array('cle_parent'=>$cle_primaire,'objet_reunion'=>$objet)));
          if (empty($d['les_participants'])) {
               $cond = array('id' => 1);
               $d['les_participants']  = $this->Poubelle->findfirst(array('conditions' => $cond));
          }
//-----------------------------------
     return $this->set($d);
}
//============================================================================================
function annuaire_discours($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Discours du Gouvernement Provincial du Maniema, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin, à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->sortants();
$this->orientes();
$this->accuses();
$this->arret();
$this->total_reunion();
$this->total_com_affect();
$this->total_ordre_mission();
$this->layout = 'gestion_acceuil';
$this->loadModel('Discour');
     $perPage = 8;
     $d['discours'] = $this->Discour->find(array(
          'fields' => `id, titre, date, orateur, date_enre, heure_enre, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['total_discours'] = $this->Discour->trouver_tout();
     $d['end_file'] = $this->Discour->dernier_enre(array());
     $d['page'] = ceil($d['total_discours'] / $perPage);
     return $this->set($d);
}
//============================================================================================
//============================================================================================
function annuaire_ordre_mission($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Arrêtés du Gouvernement Provincial du Maniema, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur ou enfin, à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->sortants();
$this->orientes();
$this->accuses();
$this->arret();
$this->total_reunion();
$this->discour();
$this->total_com_affect();
$this->total_ordre_mission();
$this->layout = 'gestion_acceuil';
$this->loadModel('Ordres_mission');
     $perPage = 8;
     $d['OR'] = $this->Ordres_mission->find(array(
          'fields' => `id, num, destination, objet, nom_titulaire_mission, fonction_titulaire_mission, date_signature, date_enr, heure_enr, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     $d['end_file'] = $this->Ordres_mission->dernier_enre(array());
     //var_dump($d['end_file']); exit;
     if (!empty($d['OR'])) {
                         $d['total_ORI'] = $this->Ordres_mission->trouver_tout();
                         $d['end_file'] = $this->Ordres_mission->dernier_enre(array());
                         $d['page'] = ceil($d['total_ORI'] / $perPage);
                         
                         return $this->set($d);
                         }else{
                              $this->Session->setFlash("Désolé, il n'existe aucun Ordre de Mission enrégistré dans le Serveur *");
                              $this->redirect('printers/annuaire_ordre_mission/'.$this->Session->user('nom'));
                              }

}
//============================================================================================
function annuaire_comm_affectation($nom_user=null){

$mes_users = array('adm_principal','Assistant_Principal','gouverneur');
if (!in_array($this->Session->user('role'),$mes_users)){
                      $this->Session->setFlash("L'accès à l'annuaire des Commission d'Affectation du Gouvernement Provincial du Maniema, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas, à l'Assistant Principal de Son Excellence Monsieur le Gouverneur, à la ParSec de Son Excellence Monsieur le Gouverneur ou enfin, à Son Excellence Monsieur le Gouverneur lui-même. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
$this->entrants();
$this->sortants();
$this->orientes();
$this->accuses();
$this->arret();
$this->discour();
$this->total_reunion();
$this->total_com_affect();
$this->total_ordre_mission();
$this->layout = 'gestion_acceuil';
$this->loadModel('Comm_affectation');
     $perPage = 8;
     $d['comm_affect'] = $this->Comm_affectation->find(array(
          'fields' => `id, num, lieu_affectation, division, Nom_personne_affect, fonction, date_signature, date_enr, heure_enr, file`,
          'limit' => ($this->request->page-1)*$perPage.','.$perPage));
     if (!empty($d['comm_affect'])) {
                         $d['total_comm_affect'] = $this->Comm_affectation->trouver_tout();
                         $d['end_file'] = $this->Comm_affectation->dernier_enre(array());
                         $d['page'] = ceil($d['total_comm_affect'] / $perPage);
                         
                         return $this->set($d);
                         }else{
                              $this->Session->setFlash("Désolé, il n'existe aucun Ordre de Mission enrégistré dans le Serveur *");
                              $this->redirect('printers/annuaire_comm_affectation/'.$this->Session->user('nom'));
                              }

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
//======================================
function total_com_affect($nom_user=null){
    $this->loadModel('Comm_affectation');
               $d['total_comm_affect'] = $this->Comm_affectation->trouver_tout();
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




}