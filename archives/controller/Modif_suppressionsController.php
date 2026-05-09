<?php
class Modif_suppressionsController extends Controller{
/*
mermet la connexion des users de notre application
*/

/*==================================================================================================*/
//======================Fonctions des modifications des courriers==============================================
//================================================================================================
function modif_AR($id = null){
  $this->entrants();
  $this->sortants();
  $this->orientes();
  $this->accuses();
  $this->arret();
  $this->total_reunion(); 
  $this->discours();
  $this->total_com_affect();
  $this->total_ordre_mission();
  $this->loadModel('Accuse');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }

  $this->layout = 'gestion_acceuil';

if ($this->request->data){
          $data = $this->request->data;

          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                    $this->Session->setFlash("Pas de type de courriers vide, veuiller selectionner le type de courriers pour continuer");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                    $this->Session->setFlash("Chaque Courrier doit avoir un numéro, saisissez-en et continuer");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit; 
                    } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                    $this->Session->setFlash("Désolé, Chaque courrier a un Son Signateur, veuillez en saisir pour continuer");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone_destina)))){
                    $this->Session->setFlash("Désolé, un numéro de téléphone est numérique, veuillez corriger et continuer");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                    $this->Session->setFlash("Vérifiez si l'objet a été saisi");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_reception)))||is_int(!htmlspecialchars(strip_tags($this->request->data->date_reception)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->date_reception)))){
                    $this->Session->setFlash("La date pose problème pour son identification");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_int(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->destinateur)))){
                    $this->Session->setFlash("Le nom du destinateur est important dans nos bases des données pour l'identification de nos accusés de reception");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->file)))||is_int(htmlspecialchars(strip_tags($this->request->data->file)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->file)))){
                    $this->Session->setFlash("Le schèmas d'accès au fichier est important dans nos bases des données pour l'identification de nos accusés de reception");
                    $this->redirect('modif_suppressions/modif_AR/'.$id);
                    exit; 
                    }
  //=====================================================================
          else{
                  /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                    $nom = $this->Session->user('nom');
                    $pst_noms = $this->Session->user('pst_noms');
                    $pr_noms = $this->Session->user('pr_noms');
                    $role = $this->Session->user('role');
                    $sexe = $this->Session->user('sexe');
                    $date_action = date('Y-m-d');
                    $heure_action = date("H:i:s");
                    $action = "Modification";
                    $commentaire_action = "Un Accusé de Reception a été Modifié";

                    $type = "Un Accusé de Reception";
                    $num = $this->request->data->num_c; 
                    $objet = $this->request->data->objet;
                    $destinateur = $this->request->data->destinateur;
                    $nom_file = $this->request->data->file;

                    $this->loadModel('Action_user');
                    //Insertion dans la bdd
                    $this->Action_user->save(array(
                                                       'nom' => $nom, 
                                                       'pst_noms'=> $pst_noms, 
                                                       'pr_noms' =>  $pr_noms, 
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
                        $this->Accuse->save($data);
                        $this->Session->setFlash("Bravo! Vous venez de modifier un Accusé de réception dans le Serveur N°: ".$this->request->data->num_c);
                        $this->redirect('printers/annuaire_accuses_de_reception/');
                        exit;
                        }

    }else{
            $cond = array('id'=>$id);
          $d['accus'] = $this->Accuse->find(array('conditions' => $cond));
          return $this->set($d);
    }  

}//Fin de la fonction
//=================================================================================================================================
//=====================================================================================================================
//=================================================================================================================================

function modif_ARE($id=null){
  $this->entrants();
  $this->sortants();
  $this->orientes();
  $this->accuses();
  $this->arret();
  $this->total_reunion(); 
  $this->discours();
  $this->total_com_affect();
  $this->loadModel('Arrete');
  $this->total_ordre_mission();
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->layout = 'gestion_acceuil';

if ($this->request->data){

          $data = $this->request->data;

          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("Il faut définir le type d'arrêté qui a été signé pour continuer, merci");
                  $this->redirect('printers/annuaire_arretes/');
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_arret)))){
                  $this->Session->setFlash("Le Numéro de l'Arrêté ne peut-être vide ou a été mal saisi");
                  $this->redirect('printers/annuaire_arretes/');
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("Un Arrêté doit porter sur un objet bien défini");
                  $this->redirect('printers/annuaire_arretes/');
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Vous êtes prier d'insérer le nom du signataire de cet Arrêté svp, merci");
                  $this->redirect('printers/annuaire_arretes/');
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_signat)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->date_signat)))){
                  $this->Session->setFlash("le format de votre date introduite est mauvais, veuillez recommencer svp");
                  $this->redirect('printers/annuaire_arretes/');
                  exit;  
                  }
  //====================================================================================
          else{
                /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                  $nom = $this->Session->user('nom');
                  $pst_noms = $this->Session->user('pst_noms');
                  $pr_noms = $this->Session->user('pr_noms');
                  $role = $this->Session->user('role');
                  $sexe = $this->Session->user('sexe');
                  $date_action = date('Y-m-d');
                  $heure_action = date("H:i:s");
                  $action = "Modification";
                  $commentaire_action = "Un Arrêté a été Modifié";

                  $type = "Un Arrêté";
                  $num = $this->request->data->num_arret; 
                  $objet = $this->request->data->objet;
                  $destinateur = "Aucun";
                  $nom_file = $this->request->data->file;

                  $this->loadModel('Action_user');
                  //Insertion dans la bdd
                  $this->Action_user->save(array(
                                                     'nom' => $nom, 
                                                     'pst_noms'=> $pst_noms, 
                                                     'pr_noms' =>  $pr_noms, 
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
                      $this->Arrete->save($data);
                      $this->Session->setFlash("Bravo! Vous venez de modifier un Arrêté dans le Serveur N°: ".$this->request->data->num_arret);
                      $this->redirect('printers/annuaire_arretes/');
                      exit;
                      }

}else{
        $cond = array('id'=>$id);
      $d['arr'] = $this->Arrete->find(array('conditions' => $cond));
      return $this->set($d);
}
}
//=================================================================================================================================
function modif_entrant($id=null){
  $this->entrants();
  $this->sortants();
  $this->orientes();
  $this->accuses();
  $this->arret();
  $this->total_reunion(); 
  $this->discours();
  $this->total_com_affect();
  $this->total_ordre_mission();
  $this->loadModel('Entrant');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->layout = 'gestion_acceuil';

if ($this->request->data){

          $data = $this->request->data;
          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("De quel type de courrier s'agit-il svp? Selectionner le type de courrier et continuer");
                  $this->redirect('modif_suppressions/modif_entrant/'.$id);
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                  $this->Session->setFlash("entrez le numéro du courrier, numéro attribué par nos services lors de sa reception pour continuer ou renvoyer-le à notre reception pour attribution de numéro. Merci");
                  $this->redirect('modif_suppressions/modif_entrant/'.$id);
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Le format date saisi est mauvais, veuillez recommencer");
                  $this->redirect('modif_suppressions/modif_entrant/'.$id);
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("l'objet du Courrier est très important pour l'identification, vérifiez et continuer");
                  $this->redirect('modif_suppressions/modif_entrant/'.$id);
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->expediteur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->expediteur)))){
                  $this->Session->setFlash("Le le nom de l'expéditeur du courrier ne peut-être vide ou numérique, veuillez corriger et recommencer");
                  $this->redirect('modif_suppressions/modif_entrant/'.$id);
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_expediteur)))||is_int(htmlspecialchars(strip_tags($this->request->data->date_expediteur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->date_expediteur)))){
                  $this->Session->setFlash("le format de la date saisi n'a pas été bien identifié par notre Serveur");
                  $this->redirect('modif_suppressions/modif_entrant/'.$id);
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone)))){
                  $this->Session->setFlash("Vérifiez le numéro de téléphone saisi et continuer");
                  $this->redirect('modif_suppressions/modif_entrant/'.$id);
                  exit;  
                  }
//====================================================================
          else{
                /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                  $nom = $this->Session->user('nom');
                  $pst_noms = $this->Session->user('pst_noms');
                  $pr_noms = $this->Session->user('pr_noms');
                  $role = $this->Session->user('role');
                  $sexe = $this->Session->user('sexe');
                  $date_action = date('Y-m-d');
                  $heure_action = date("H:i:s");
                  $action = "Modifié";
                  $commentaire_action = "Un Courrier entrant a été Modifié";

                  $type = "Un Courrier entrant";
                  $num = $this->request->data->num_c; 
                  $objet = $this->request->data->objet;
                  $destinateur = $this->request->data->expediteur;
                  $nom_file = $this->request->data->file;

                  $this->loadModel('Action_user');
                  //Insertion dans la bdd
                  $this->Action_user->save(array(
                                                     'nom' => $nom, 
                                                     'pst_noms'=> $pst_noms, 
                                                     'pr_noms' =>  $pr_noms, 
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
                      $this->Entrant->save($data);
                      $this->Session->setFlash("Bravo! Vous venez de modifier un Courrier entrant dans le Serveur N°: ".$this->request->data->num_c);
                      $this->redirect('printers/annuaire_courriers_entrants/');
                      exit;
                      }

}else{
      $cond = array('id'=>$id);
      $d['modifie_entr'] = $this->Entrant->find(array('conditions' => $cond));
      return $this->set($d);
}
}
//=================================================================================================================================
function modif_ori($id=null){
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->arret();
                  $this->total_reunion(); 
                  $this->discours();
                  $this->total_com_affect();
                  $this->total_ordre_mission();
                  $this->loadModel('Oriente');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->layout = 'gestion_acceuil';
  if ($this->request->data) {

          $data = $this->request->data;
          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("Veuillez spécifier le type de courrier soumis pour traitement");
                  $this->redirect('modif_suppressions/modif_ori/'.$id);
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->exploitant)))||is_int(htmlspecialchars(strip_tags($this->request->data->exploitant)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->exploitant)))){
                  $this->Session->setFlash("Veuillez spécifier le la fonction ou nom de l'exploitant de ce courrier soumis pour traitement");
                  $this->redirect('modif_suppressions/modif_ori/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                  $this->Session->setFlash("Veuillez spécifier le Numéro de ce courrier soumis pour traitement");
                  $this->redirect('modif_suppressions/modif_ori/'.$id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Veuillez spécifier le Nom  de l'expéditeur de ce courrier soumis pour traitement");
                  $this->redirect('modif_suppressions/modif_ori/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone_destina)))){
                  $this->Session->setFlash("Veuillez spécifier le Numéro de téléphone de l'expéditeur de ce courrier soumis pour traitement");
                  $this->redirect('modif_suppressions/modif_ori/'.$id);  
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("Veuillez spécifier l'objet de ce courrier qui est orienté");
                  $this->redirect('modif_suppressions/modif_ori/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_rient)))||is_int(htmlspecialchars(strip_tags($this->request->data->date_rient)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->date_rient)))){
                  $this->Session->setFlash("Veuillez spécifier la date à laquelle l'Autorité a orientaté ce courrier pour traitement");
                  $this->redirect('modif_suppressions/modif_orit/'.$id);
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->gouv_orient)))||is_int(htmlspecialchars(strip_tags($this->request->data->gouv_orient)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->gouv_orient)))){
                  $this->Session->setFlash("Veuillez spécifier la mention d'orientation de l'Autorité pour le traitement de ce courrier");
                  $this->redirect('modif_suppressions/modif_ori/'.$id); 
                  exit;  
                  }
//===========================================================
          else{
                /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                  $nom = $this->Session->user('nom');
                  $pst_noms = $this->Session->user('pst_noms');
                  $pr_noms = $this->Session->user('pr_noms');
                  $role = $this->Session->user('role');
                  $sexe = $this->Session->user('sexe');
                  $date_action = date('Y-m-d');
                  $heure_action = date("H:i:s");
                  $action = "Modification";
                  $commentaire_action = "Un Courrier Orienté pour exploitation chez .$this->request->data->Exploitant. a été modifié";

                  $type = "Un Courrier Orienté pour exploitation";
                  $num = $this->request->data->num_c; 
                  $objet = $this->request->data->objet;
                  $destinateur = $this->request->data->Exploitant;
                  $nom_file = $this->request->data->file;

                  $this->loadModel('Action_user');
                  //Insertion dans la bdd
                  $this->Action_user->save(array(
                                                     'nom' => $nom, 
                                                     'pst_noms'=> $pst_noms, 
                                                     'pr_noms' =>  $pr_noms, 
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
                      $this->Oriente->save($data);
                      $this->Session->setFlash("Bravo! Vous venez de modifier un Courrier entrant-Orienté dans le Serveur N°: ".$this->request->data->num_c);
                      $this->redirect('printers/annuaire_courriers_entrants_orientes/');
                      exit;
                      }

}else{
      $cond = array('id'=>$id);
      $d['modifie_ori'] = $this->Oriente->find(array('conditions' => $cond));
      return $this->set($d);
}
}
//=================================================================================================================================
function modif_reunion($id=null){
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->arret();
                  $this->total_reunion();
                  $this->discours();
                  $this->total_com_affect();
                  $this->total_ordre_mission(); 
                  $this->loadModel('Reunion');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
                  $this->layout = 'gestion_acceuil';
  if ($this->request->data) {
          $data = $this->request->data;
          if (empty(htmlspecialchars(strip_tags($this->request->data->lieu_reunion)))||is_int(htmlspecialchars(strip_tags($this->request->data->lieu_reunion)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->lieu_reunion)))){
                  $this->Session->setFlash("Veuillez préciser le lieu où s'est tenue la réunion svp");
                  $this->redirect('modif_suppressions/modif_reunion/'.$data->id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->fonction)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->fonction)))){
                  $this->Session->setFlash("La Fonction du participant à la réunion est obligatoir pour continuer, Veuillez l'inscrire avant de continuer");
                  $this->redirect('modif_suppressions/modif_reunion/'.$data->id); 
                  exit;  
                  }
            elseif (empty($this->request->data->date)){
                  $this->Session->setFlash("le format date n'est pas supporté par notre serveur");
                  $this->redirect('modif_suppressions/modif_reunion/'.$data->id);
                  exit;  
                  }
            elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("Vérifiez si l'objet de ce courrier a bel et bien été bien saisi, puis continuer");
                  $this->redirect('modif_suppressions/modif_reunion/'.$data->id); 
                  exit;  
                  }
//==================================================================================
          else{
                /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                  $nom = $this->Session->user('nom');
                  $pst_noms = $this->Session->user('pst_noms');
                  $pr_noms = $this->Session->user('pr_noms');
                  $role = $this->Session->user('role');
                  $sexe = $this->Session->user('sexe');
                  $date_action = date('Y-m-d');
                  $heure_action = date("H:i:s");
                  $action = "Modification du titre de la Réunion";
                  $commentaire_action = "Un titre de la Réunion a été modifié";

                  $type = "titre de la Réunion";
                  $num = $this->request->data->date_enre; 
                  $objet = $this->request->data->objet;
                  $destinateur = $this->request->data->fonction;
                  $nom_file = $this->request->data->heure_enre;

                  $this->loadModel('Action_user');
                  //Insertion dans la bdd
                  $this->Action_user->save(array(
                                                     'nom' => $nom, 
                                                     'pst_noms'=> $pst_noms, 
                                                     'pr_noms' =>  $pr_noms, 
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
                      $this->Reunion->save($data);
                      $this->Session->setFlash("Bravo! Vous venez de modifier le Titre/Objet de la réunion dans le Serveur ");
                      $this->redirect('printers/annuaire_reunion/');
                      exit;
                      }

      }else{
            $cond = array('id'=>$id);
            $d['modifie_reunion'] = $this->Reunion->findfirst(array('conditions' => $cond));
            return $this->set($d);
      }
}
//=================================================================================================================================
function modif_sort($id=null){
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->arret();
                  $this->total_reunion();
                  $this->discours();
                  $this->total_com_affect();
                  $this->total_ordre_mission();
                  $this->layout = 'gestion_acceuil';
                    $this->loadModel('Sortant');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  if ($this->request->data) {

          $data = $this->request->data;
          if (empty(htmlspecialchars(strip_tags($this->request->data->type)))||is_int(htmlspecialchars(strip_tags($this->request->data->type)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->type)))){
                  $this->Session->setFlash("De quel type de courrier s'agit-il svp? Delectionner le type de courrier et continuer");
                  $this->redirect('modif_suppressions/modif_sort/'.$id); 
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_c)))){
                  $this->Session->setFlash("Le numéro du Courrier sortant est très important, veuillez compléter et continuer");
                  $this->redirect('modif_suppressions/modif_sort/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))||is_int(htmlspecialchars(strip_tags($this->request->data->objet)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->objet)))){
                  $this->Session->setFlash("L'objet de ce courrier a été homis ou saisi en numérique, veuillez recommencer");
                  $this->redirect('modif_suppressions/modif_sort/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_int(htmlspecialchars(strip_tags($this->request->data->nom_sign)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->nom_sign)))){
                  $this->Session->setFlash("Le nom du Signateur de ce courrier a été homis ou saisi en numérique, veuillez recommencer");
                  $this->redirect('modif_suppressions/modif_sort/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_sign)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->date_sign)))){
                  $this->Session->setFlash("la date est en format non pris en compte par notre serveur");
                  $this->redirect('modif_suppressions/modif_sort/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->num_phone)))||is_int(!htmlspecialchars(strip_tags($this->request->data->num_phone)))||is_numeric(!htmlspecialchars(strip_tags($this->request->data->num_phone)))){
                  $this->Session->setFlash("Veuillez revoir le numéro de téléphone saisi");
                  $this->redirect('modif_suppressions/modif_sort/'.$id); 
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_int(htmlspecialchars(strip_tags($this->request->data->destinateur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->destinateur)))){
                  $this->Session->setFlash("Vous devez spécifier le nom du destinateur de ce courrier svp");
                  $this->redirect('modif_suppressions/modif_sort/'.$id); 
                  exit;  
                  }
//=========================================================================
          else{
                /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                  $nom = $this->Session->user('nom');
                  $pst_noms = $this->Session->user('pst_noms');
                  $pr_noms = $this->Session->user('pr_noms');
                  $role = $this->Session->user('role');
                  $sexe = $this->Session->user('sexe');
                  $date_action = date('Y-m-d');
                  $heure_action = date("H:i:s");
                  $action = "Modification";
                  $commentaire_action = "Un Courrier Sortant a été modifié";

                  $type = "Un Courrier Sortant";
                  $num = $this->request->data->num_c; 
                  $objet = $this->request->data->objet;
                  $destinateur = $this->request->data->destinateur;
                  $nom_file = $this->request->data->file;

                  $this->loadModel('Action_user');
                  //Insertion dans la bdd
                  $this->Action_user->save(array(
                                                     'nom' => $nom, 
                                                     'pst_noms'=> $pst_noms, 
                                                     'pr_noms' =>  $pr_noms, 
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

                      $this->Sortant->save($data);
                      $this->Session->setFlash("Bravo! Vous venez de modifier un Courrier sortant dans le Serveur N°: ".$this->request->data->num_c);
                      $this->redirect('printers/annuaire_courriers_sortants/');
                      exit;
                      }

}else{
      $cond = array('id'=>$id);
      $d['modifie_sortant'] = $this->Sortant->find(array('conditions' => $cond));
      return $this->set($d);
}
}
//==========================================================================================================

function modif_disc($id=null){
                    $this->entrants();
                    $this->sortants();
                    $this->orientes();
                    $this->accuses();
                    $this->arret();
                    $this->total_reunion();
                    $this->discours();
                    $this->total_com_affect();
                    $this->total_ordre_mission();
                    $this->layout = 'gestion_acceuil';
                      $this->loadModel('Discour');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  if ($this->request->data) {

          $data = $this->request->data;
          if (empty(htmlspecialchars(strip_tags($this->request->data->date)))||is_int(htmlspecialchars(strip_tags($this->request->data->date)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->date)))){
                  $this->Session->setFlash("Une date de la tenue du discours est obligatoire pour continuer");
                  $this->redirect('modif_suppressions/modif_disc/'.$id); 
                  exit;  
                  } 
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->titre)))){
                  $this->Session->setFlash("Un titre est très important, veuillez compléter et continuer");
                  $this->redirect('modif_suppressions/modif_disc/'.$id);
                  exit;  
                  }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->orateur)))||is_int(htmlspecialchars(strip_tags($this->request->data->orateur)))||is_numeric(htmlspecialchars(strip_tags($this->request->data->orateur)))){
                  $this->Session->setFlash("Le nom de la personne qui a tenu ce discours a été homis ou saisi en numérique, veuillez recommencer");
                  $this->redirect('modif_suppressions/modif_disc/'.$id);
                  exit;  
                  }
//=========================================================================
          else{
                /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                  $nom = $this->Session->user('nom');
                  $pst_noms = $this->Session->user('pst_noms');
                  $pr_noms = $this->Session->user('pr_noms');
                  $role = $this->Session->user('role');
                  $sexe = $this->Session->user('sexe');
                  $date_action = date('Y-m-d');
                  $heure_action = date("H:i:s");
                  $action = "Modification";
                  $commentaire_action = "Un discours a été modifié";

                  $type = "Un Discours";
                  $num = 'date de modification de ce Discours: '.$this->request->data->date; 
                  $objet = 'date de modification de ce Discours: '.$this->request->data->titre;
                  $destinateur = 'date de modification de ce Discours: '.$this->request->data->orateur;
                  $nom_file = 'date de modification de ce Discours: '.$this->request->data->file;

                  $this->loadModel('Action_user');
                  //Insertion dans la bdd
                  $this->Action_user->save(array(
                                                     'nom' => $nom, 
                                                     'pst_noms'=> $pst_noms, 
                                                     'pr_noms' =>  $pr_noms, 
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

                      $this->Discour->save($data);
                      $this->Session->setFlash("Bravo! Vous venez de modifier un Discours dans le Serveur");
                      $this->redirect('printers/annuaire_discours/');
                      exit; 
                      }

}else{
      $cond = array('id'=>$id);
      $d['modifie_discours'] = $this->Discour->find(array('conditions' => $cond));
      return $this->set($d);
}
}
function modif_ordre_mission($id=null){
                 $this->layout = 'gestion_acceuil';
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->arret();
                  $this->total_reunion();
                  $this->discours();
                  $this->total_ordre_mission();
                  $this->total_com_affect();
                  $this->loadModel('Ordres_mission');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  if ($this->request->data) {

          $data = $this->request->data;
          if (empty(htmlspecialchars(strip_tags($this->request->data->num)))){
                    $this->Session->setFlash("Veuillez entrer le numéro de cet Ordre de Mission pour continuer");
                    $this->redirect('modif_suppressions/modif_ori/'.$id);
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->destination)))){
                    $this->Session->setFlash("Veuillez entrer la destination pour cet Ordre de Mission pour continuer");
                    $this->redirect('printers/ordre_mission/'.$this->Session->user('nom'));
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->objet)))){
                    $this->Session->setFlash("Veuillez entrer l'Objet de cet Ordre de Mission pour continuer");
                    $this->redirect('modif_suppressions/modif_ori/'.$id);
                    exit; 
                    }
          if (empty(htmlspecialchars(strip_tags($this->request->data->nom_titulaire_mission)))){
                    $this->Session->setFlash("Veuillez entrer le nom du titulaire de cet Ordre de Mission pour continuer");
                    $this->redirect('modif_suppressions/modif_ori/'.$id);
                    exit;  
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->fonction_titulaire_mission)))){
                    $this->Session->setFlash("Veuillez entrer la Fonction du Titulaire de cet Ordre de Mission pour continuer");
                    $this->redirect('modif_suppressions/modif_ori/'.$id);
                    exit; 
                    }
          elseif (empty(htmlspecialchars(strip_tags($this->request->data->date_signature)))){
                    $this->Session->setFlash("Veuillez entrer la date de signature de cet Ordre de Mission pour continuer");
                    $this->redirect('modif_suppressions/modif_ori/'.$id);
                    exit; 
                    }

          else{ 
                  /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                    $nom = $this->Session->user('nom');
                    $pst_noms = $this->Session->user('pst_noms');
                    $pr_noms = $this->Session->user('pr_noms');
                    $role = $this->Session->user('role');
                    $sexe = $this->Session->user('sexe');
                    $date_action = date('Y-m-d');
                    $heure_action = date("H:i:s");
                    $action = "Modification";
                    $commentaire_action = "Un Ordre de mission a été Modifié";

                    $type = ' <- Nom du titulaire modifié : '.$this->request->data->nom_titulaire_mission;
                    $num = ' <- le numéro de l\'ordre de mission modifié supprimé *'.$this->request->data->num; 
                    $objet = ' <- destination OR modifié *'.$this->request->data->destination;
                    $destinateur = ' <- Fonction du titulaire de l\OR modifié *'.$this->request->data->fonction_titulaire_mission;
                    $nom_file = 'Le nom du fichier modifié : '.$this->request->data->file;

                    $this->loadModel('Action_user');
                    //Insertion dans la bdd
                    $this->Action_user->save(array(
                                                       'nom' => $nom, 
                                                       'pst_noms'=> $pst_noms, 
                                                       'pr_noms' =>  $pr_noms, 
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

                      $this->Ordres_mission->save($data);
                      $this->Session->setFlash("Bravo! Vous venez de modifier un Ordre de Mission dans le Serveur");
                      $this->redirect('printers/annuaire_ordre_mission/');
                      exit;
                } 
          }else{////si erreur du fichier!=0 c'est que le pdf est de mauvaise qualité
                  $cond = array('id'=>$id);
                  $d['modifie_ordre_mission'] = $this->Ordres_mission->find(array('conditions' => $cond));
                  return $this->set($d);
                  } 
}
//=======================================================================================================
function modif_comm_affect($id = null){
  //var_dump($_POST);exit;
                  $this->layout = 'gestion_acceuil';
                  $this->entrants();
                  $this->sortants();
                  $this->orientes();
                  $this->accuses();
                  $this->total_reunion();
                  $this->reunion();
                  $this->discours();
                  $this->total_ordre_mission();
                  $this->total_com_affect();
                  $this->loadModel('Comm_affectation');
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour faire cette modification, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  if ($this->request->data) {
                  $data = $this->request->data;

                  if (empty(htmlspecialchars(strip_tags($this->request->data->num)))){
                            $this->Session->setFlash("Veuillez entrer le numéro de cette Commission pour continuer");
                            $this->redirect('modif_suppressions/comm_affectation/'.$id);
                            exit;  
                            }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->lieu_affectation)))){
                            $this->Session->setFlash("Veuillez entrer le lieux d'affectation de cette Commission pour continuer");
                            $this->redirect('modif_suppressions/comm_affectation/'.$id);
                            exit; 
                            }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->division)))){
                            $this->Session->setFlash("Veuillez entrer le nom de la division de cette Commission pour continuer");
                            $this->redirect('modif_suppressions/comm_affectation/'.$id);
                            exit; 
                            }
                  if (empty(htmlspecialchars(strip_tags($this->request->data->Nom_personne_affect)))){
                            $this->Session->setFlash("Veuillez entrer le nom de la personne de cette Commission pour continuer");
                            $this->redirect('modif_suppressions/comm_affectation/'.$id);
                            exit;  
                            }
                  elseif (empty(htmlspecialchars(strip_tags($this->request->data->fonction)))){
                            $this->Session->setFlash("Veuillez entrer la Fonction de la personne affectée de cette Commission pour continuer");
                            $this->redirect('modif_suppressions/comm_affectation/'.$id);
                            exit; 
                            }
                  else{ 
                            
                  /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
                    $nom = $this->Session->user('nom');
                    $pst_noms = $this->Session->user('pst_noms');
                    $pr_noms = $this->Session->user('pr_noms');
                    $role = $this->Session->user('role');
                    $sexe = $this->Session->user('sexe');
                    $date_action = date('Y-m-d');
                    $heure_action = date("H:i:s");
                    $action = "Modification d\'une Commission";
                    $commentaire_action = "une Commission d\'Affectation a été Modifiée";

                    $type = ' <- Cette Commission d\'affectation modifié fut de la Division : '.$this->request->data->division;
                    $num = ' <- le numéro de la Commission d\'affectation modifié *'.$this->request->data->num; 
                    $objet = ' <- -------- *';
                    $destinateur = ' <- --------------- *';
                    $nom_file = 'Le nom du fichier modifié : '.$this->request->data->file;

                    $this->loadModel('Action_user');
                    //Insertion dans la bdd
                    $this->Action_user->save(array(
                                                       'nom' => $nom, 
                                                       'pst_noms'=> $pst_noms, 
                                                       'pr_noms' =>  $pr_noms, 
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
                      $this->Comm_affectation->save($data);

                      $this->Session->setFlash("Bravo! Vous venez de modifier une Commission d'Affectation dans le Serveur");
                      $this->redirect('printers/annuaire_comm_affectation/');
                      exit;
                } 
          }else{////si erreur du fichier!=0 c'est que le pdf est de mauvaise qualité
                  $cond = array('id'=>$id);
                  $d['modifie_comission'] = $this->Comm_affectation->find(array('conditions' => $cond));
                  return $this->set($d);
                  } 
}
//=======================================================================================================
//Fonctions des suppressions
//==========================================================================================================
function suppression_AR($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Accusé Reception, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Accuse');
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');

//on recupère d'abord l'id du fichier dans la bdd pour le stocker afin de nous permettre de supprimer son fichier dans webroot
  $media = $this->Accuse->findFirst(array(
  'conditions' => array('id'=>$id)));
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');
  $fichier = (router::webroot('accuses_reception/'.$media->file));
  unlink($fichier);
  //=====================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Accusé de Reception a été suppremé";

      $type = "Un Accusé de Reception";
      $num = $media->num_c; 
      $objet = $media->objet;
      $destinateur = $media->destinateur;
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Accuse->delete($id);

  $this->Session->setFlash("Vous venez de supprimer un Accusé de Reception du Serveur N°: ".$media->num_c);
  $this->redirect('printers/annuaire_accuses_de_reception/');
  exit;
}
function suppression_ARE($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Arrêté, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Arrete');
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');

//on recupère d'abord l'id du fichier dans la bdd pour le stocker afin de nous permettre de supprimer son fichier dans webroot
  $media = $this->Arrete->findFirst(array('conditions' => array('id'=>$id)));
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');
  $fichier = (router::webroot('les_arrêtes/'.$media->file));
  unlink($fichier);

  //====================================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Arrêté a été supprimé";

      $type = "Un Arrêté";
      $num = $media->num_arret; 
      $objet = $media->objet;
      $destinateur = "Aucun";
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Arrete->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un Arrêté du Serveur N°: ".$media->num_arret);
  $this->redirect('printers/annuaire_arretes/');
  exit;
}
function suppression_entrant($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Courrier Entrant, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Entrant');
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');

//on recupère d'abord l'id du fichier dans la bdd pour le stocker afin de nous permettre de supprimer son fichier dans webroot
  $media = $this->Entrant->findFirst(array('conditions' => array('id'=>$id)));
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');
  //$fichier = (router::webroot('courriers_entrants/'.$media->file));
  //unlink($fichier);
//====================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Courrier entrant a été supprimé";

      $type = "Un Courrier entrant";
      $num = $media->num_c; 
      $objet = $media->objet;
      $destinateur = $media->expediteur;
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Entrant->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un courrier entrant du Serveur N°: ".$media->num_c);
  $this->redirect('printers/annuaire_courriers_entrants/');
  exit;
}
function suppression_ori($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Courrier Orienté, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Oriente');
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');

//on recupère d'abord l'id du fichier dans la bdd pour le stocker afin de nous permettre de supprimer son fichier dans webroot
  $media = $this->Oriente->findFirst(array('conditions' => array('id'=>$id)));
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');
  //$fichier = (router::webroot('courriers_orientes/'.$media->file));
  //unlink($fichier);
//===========================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Courrier Orienté pour exploitation chez .$media->Exploitant. a été supprimé";

      $type = "Un Courrier Orienté pour exploitation";
      $num = $media->num_c; 
      $objet = $media->objet;
      $destinateur = $media->Exploitant;
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Oriente->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un courrier entrant orienté de notre Serveur N°: ".$media->num_c);
  $this->redirect('printers/annuaire_courriers_entrants_orientes/');
  exit;
}
function suppression_participant($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'une Réunion, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Reunion');
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');

//on recupère d'abord l'id du fichier dans la bdd pour le stocker afin de nous permettre de supprimer son fichier dans webroot
  $media = $this->Reunion->findFirst(array('conditions' => array('id'=>$id)));
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');
  //$fichier = (router::webroot('liste_de_presence/'.$media->file));
  //unlink($fichier);
//==================================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Nom d'un Paerticipant à la Réunion a été supprimé";

      $type = "Nom d'un Paerticipant à la Réunion";
      $num = $media->nom; 
      $objet = $media->objet;
      $destinateur = $media->fonction;
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Reunion->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un de participant du Serveur.");
  $this->redirect('printers/liste_presence_reunion_gouv/');
  exit;
}
function suppression_sort($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Courrier Sortant, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Sortant');
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');

//on recupère d'abord l'id du fichier dans la bdd pour le stocker afin de nous permettre de supprimer son fichier dans webroot
  $media = $this->Sortant->findFirst(array('conditions' => array('id'=>$id)));
// puis on supprime le fichier dans WEBROOT.DS.'img'.DS.date('Y-m');
  $fichier = (router::webroot('courriers_sortants/'.$media->file));
  unlink($fichier);
//=========================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Courrier Sortant a été supprimé";

      $type = "Un Courrier Sortant";
      $num = $media->num_c; 
      $objet = $media->objet;
      $destinateur = $media->destinateur;
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Sortant->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un Courrier sortant du Serveur N°: ".$media->num_c);
  $this->redirect('printers/annuaire_courriers_sortants/');
  exit;
}
//===================================================================================
function suppr_disc($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Discours, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Discour');
  $media = $this->Discour->findFirst(array('conditions' => array('id'=>$id)));
//====================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Discours a été supprimé";

      $type = "Discours";
      $num = $media->date; 
      $objet = $media->titre;
      $destinateur = " Aucun";
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Discour->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un Discours du Serveur ");
  $this->redirect('printers/annuaire_discours/');
  exit;
}
//============================================================================================
function suppr_user($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Utilisateur de ce logiciel, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('User');
  $media = $this->User->findFirst(array('conditions' => array('id'=>$id)));
//====================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Utilisateur a été supprimé";

      $type = $media->nom.' <- Nom de User supprimé *';
      $num = $media->pst_noms.' <- Post-Nom de User supprimé *'; 
      $objet = $media->pr_noms.' <- Prénom de User supprimé *';
      $destinateur = $media->role.' <- Fonction de User supprimé *';
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->User->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un Utilisateur du Serveur ");
  $this->redirect('users/printers_user/');
  exit;
}
function suppr_ordre_mission($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'un Ordre de Mission, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Ordres_mission');
  $media = $this->Ordres_mission->findFirst(array('conditions' => array('id'=>$id)));
//====================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Un Ordre de mission a été supprimé";

      $type = ' <- Nom du titulaire supprimé *'.$media->nom_titulaire_mission;
      $num = ' <- le numéro de l\'ordre de mission supprimé supprimé *'.$media->num; 
      $objet = ' <- destination OR supprimé *'.$media->destination;
      $destinateur = ' <- Fonction du titulaire de l\OR supprimé *'.$media->fonction_titulaire_mission;
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Ordres_mission->delete($id);
  $this->Session->setFlash("Vous venez de supprimer un Ordre de Mission/Feuille de route du Serveur ");
  $this->redirect('printers/annuaire_ordre_mission/');
  exit;  
}
function suppr_comission($id){
if ($this->Session->user('role')!=='adm_principal') {
                      $this->Session->setFlash("Pour effectuer une suppression d'une Commission d'affectation, il vous faut s'adresser directement à l'Administrateur Principal de ce logiciel du Nom de Monsieur Anastas. Merci");
                      $this->redirect('gestionnaire/acceuil_admin/');
                      exit;
                      }
  $this->loadModel('Comm_affectation');
  $media = $this->Comm_affectation->findFirst(array('conditions' => array('id'=>$id)));
//====================================================================
    /*Recupération des des identités du user, la date et l'heure de la suppression du fichier dans notre serveur*/
      $nom = $this->Session->user('nom');
      $pst_noms = $this->Session->user('pst_noms');
      $pr_noms = $this->Session->user('pr_noms');
      $role = $this->Session->user('role');
      $sexe = $this->Session->user('sexe');
      $date_action = date('Y-m-d');
      $heure_action = date("H:i:s");
      $action = "suppression";
      $commentaire_action = "Une Comission a été supprimée";

      $type = ' <- Nom Commission supprimé est de la division: *'.$media->division;
      $num = ' <- le numéro Comission supprimé *'.$media->num; 
      $objet = ' <- --------- *';
      $destinateur = ' <- -------- *';
      $nom_file = $media->file;

      $this->loadModel('Action_user');
      //Insertion dans la bdd
      $this->Action_user->save(array(
                                         'nom' => $nom, 
                                         'pst_noms'=> $pst_noms, 
                                         'pr_noms' =>  $pr_noms, 
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
  $this->Comm_affectation->delete($id);
  $this->Session->setFlash("Vous venez de supprimer une Comission du Serveur ");
  $this->redirect('printers/annuaire_comm_affectation/');
  exit;  
}
//============================================================================================

//Coptation des toutes mes bases

function entrants($nom_user=null){
    $this->loadModel('Entrant');
               $d['total_entrants'] = $this->Entrant->trouver_tout();

  return $this->set($d);
}
//============================================================================================

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

function discours($nom_user=null){
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


}