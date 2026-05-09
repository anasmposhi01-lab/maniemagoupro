  <main id="main">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 style="text-align: center;font-family:Imprint MT Shadow,Arial,sans-serif;text-transform: uppercase;">Bienvenue dans l'Amnistrateur de Courriers du Gouvernement Provincial du Maniema</h2>
        <center><div class="row gy-1">
               <div class="col-lg-4">
                   <div class="portfolio-details-slider swiper">
                         <div class="swiper-wrapper align-items-center">
                                  <div class="swiper-slide">
                                      <a  href="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>">
                                        <img  class="anas1" src="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>"  alt="">
                                      </a>
                                      <?php echo ($this->Session->user('sexe')=='homme')?  '<b style="color:red;">Monsieur '.$this->Session->user("nom").'</b> vous êtes Connecté': '<b style="color:red;">Madame '.$this->Session->user("nom").'</b> vous êtes Connectée'; ?>
                                  </div>
                                  <div class="swiper-slide">
                                      <a  href="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>">
                                        <img  class="anas1" src="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>"  alt="">
                                      </a>
                                      <?php echo ($this->Session->user('sexe')=='homme')?  '<b style="color:red;">Monsieur '.$this->Session->user("nom").'</b> vous êtes Connecté': '<b style="color:red;">Madame '.$this->Session->user("nom").'</b> vous êtes Connectée'; ?>
                                  </div>
                                  <div class="swiper-slide">
                                      <a  href="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>">
                                        <img  class="anas1" src="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>"  alt="">
                                      </a>
                                      <?php echo ($this->Session->user('sexe')=='homme')?  '<b style="color:red;">Monsieur '.$this->Session->user("nom").'</b> vous êtes Connecté': '<b style="color:red;">Madame '.$this->Session->user("nom").'</b> vous êtes Connectée'; ?>
                                  </div>
                        </div>
                   <div class="swiper-pagination"></div>
               </div>
        </div></center><br>
          <p><h1 style="text-align: justify;font-family:Edwardian Script ITC,Arial,sans-serif;">L'administration de cette application consistera à l'accès à tous les Courriers: (i) Entrants; (ii) Sortants; (iii) Courriers Entrants Orientés; (iv) Les Accusés Receptions; (v) Les Discours du Gouvernement et; (vi) Les Arrêtés. Il permet également d'uploader les Courriers et un accès à tous les annuaires. Une recherche fluide et un accès aux réunions tenues par le Gouvernement Provincial du Maniema, contenues et liste de tous les participants pour chacune de réunions tenues.</h1></p>
          <h4><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></h4>          
        <div class="row">
          <div class="col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <i class="bi bi-briefcase"></i>
              <h4><a href="#">1. CETTE PAGE VOUS PERMET L'ENREGISTREMENT DES NOUVEAUX COURRIERS ENTRANTS</a></h4>
              <p>                                  
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-lightning-charge-fill"></i>
                    <a onclick="return confirm('Voulez-vous enrégistrer un nouveau courrier entrant dans le Serveur?');" href="<?php echo Router::url('uploader/courriers_entrants/'.$this->Session->user('role'));?>">
                      Cliquez 👉 pour enrégistrer un nouveau courrier entrant;
                    </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4 style="margin-left: 50px;"><a href="#">A. ANNUAIRE DES COURRIERS ENTRANTS</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                      <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire courriers entrants déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_courriers_entrants/'.$this->Session->user('role'));?>">
                        Cliquez 👉 pour accèder à l'Annuaire courriers entrants
                      </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-card-checklist"></i>
              <h4><a href="#">2. CETTE PAGE VOUS PERMET L'ENREGISTREMENT DES NOUVEAUX COURRIERS SORTANTS</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-lightning-charge-fill"></i>                                  
                    <a onclick="return confirm('Voulez-vous enrégistrer un nouveau courrier sortant dans le Serveur?');" href="<?php echo Router::url('uploader/courriers_sortants/'.$this->Session->user('role'));?>">
                      Cliquez 👉 pour enrégistrer un nouveau courrier sortant;
                    </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4 style="margin-left: 50px;"><a href="#">B. ANNUAIRE DES COURRIERS SORTANTS</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                      <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire Courriers Sortants déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_courriers_sortants/'.$this->Session->user('role'));?>">
                         Cliquez 👉 pour accèder à l'Annuaire courriers Sortants
                       </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>  
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-bar-chart"></i>
              <h4><a href="#">3. CETTE PAGE VOUS PERMET L'ENREGISTREMENT DES COURRIERS ENTRANTS ORIENTES</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-lightning-charge-fill"></i>                                  
                    <a onclick="return confirm('Voulez-vous enrégistrer un nouveau Courrier Orienté dans le Serveur?');" href="<?php echo Router::url('uploader/courriers_entrants_orientes/'.$this->Session->user('role'));?>">
                      Cliquez 👉 pour enrégistrer Un Courrier Orienté;
                    </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4 style="margin-left: 50px;"><a href="#">C. ANNUAIRE DES COURRIERS ENTRANTS ORINTES</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                      <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Courriers Orientés déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_courriers_entrants_orientes/'.$this->Session->user('role'));?>">
                          Cliquez 👉 pour accèder à l'Annuaire des Courriers entrants Orientés
                      </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-binoculars"></i>
              <h4><a href="#">4. CETTE PAGE VOUS PERMET L'ENREGISTREMENT DES ACCUSES RECEPTION</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill"></i>                                  
                    <a onclick="return confirm('Voulez-vous enrégistrer un nouveau accusé de reception dans le Serveur?');" href="<?php echo Router::url('uploader/accuse_reception/'.$this->Session->user('role'));?>">
                      Cliquez 👉 pour enrégistrer Un Accusé de Réception;
                    </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4 style="margin-left: 50px;"><a href="#">D. ANNUAIRE DES ARRÊTES</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                      <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Arrêtés déjà enrôlée?');" href="<?php echo Router::url('printers/annuaire_arretes/'.$this->Session->user('role'));?>">
                         Cliquez 👉 pour accèder à l'Annuaire des Arrêtés
                      </a>
                  </li>
                </ul>
              </p>
            </div>
          </div> 
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4><a href="#">5. CETTE PAGE VOUS PERMET L'ENREGISTREMENT DES NOUVEAUX ARRETES</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                     <a onclick="return confirm('Voulez-vous  enrégistrer un nouveau arrêté dans le Serveur?');" href="<?php echo Router::url('uploader/arretes/'.$this->Session->user('role'));?>">
                       Cliquez 👉 pour enrégistrer un nouveau Arrêté;
                     </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
<!-- ------------Les annuaires---------------------------- -->



 
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4 style="margin-left: 50px;"><a href="#">E. ANNUAIRE DES ACCUSES RECEPTION</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                      <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Accusés de réceptions déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_accuses_de_reception/'.$this->Session->user('role'));?>">
                          👉 Annuaire Accusé de Réception;
                      </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4 style="margin-left: 50px;"><a href="#">6. ANNUAIRE DES REUNIONS</a></h4>
              <p>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                      <a onclick="return confirm('Voulez-vous accèder à la liste de présence des réunions tenues par Son Excellence Monsieur le Gouverneur ou son mendataire dans le Serveur?');" href="<?php echo Router::url('printers/liste_presence_reunion_gouv/'.$this->Session->user('role'));?>">
                         👉 Annuaire des réunions;
                       </a>
                  </li>
                </ul>
              </p>
            </div>
          </div>  
<!-----------------------Les accès pour l'admin Principal---------------------------------------------------------->
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4><a href="#">F. Les Actions Administrateur</a></h4>
              <p>Juste Pour l'Administrateur de cette Application:
                <ul  style="text-align: justify;font-family:Helvetica,Arial,sans-serif;text-transform: uppercase;">
                  <?php echo ($this->Session->user('role')!=='adm_principal')? '<li hidden>
                    <a onclick="return confirm("Voulez-vous vraiment acceder à la iste des Users du Serveur?");" href="<?php echo Router::url("users/printers_user/".$this->Session->user("role"));?>">
                       👉 liste des Utilisateurs du site;
                     </a>
                  </li>':'<li>
                    <a onclick="return confirm("Voulez-vous vraiment acceder à la iste des Users du Serveur?");"  href="'.Router::url('users/printers_user/'.$this->Session->user('role')).'">
                       👉 liste des Utilisateurs du site;
                     </a>
                  </li>'; ?>
                  <?php echo ($this->Session->user('role')!=='adm_principal')? '<li hidden>
                    <a onclick="return confirm("Voulez-vous vraiment créer un nouveau user du Serveur?");" href="<?php echo Router::url("users/uploader_user/".$this->Session->user("role"));?>">
                       👉 Ajouter un Utilisateur;
                     </a>
                  </li>':'<li>
                    <a onclick="return confirm("Voulez-vous vraiment créer un nouveau user du Serveur?");"  href="'.Router::url('users/uploader_user/'.$this->Session->user('role')).'">
                       👉 Ajouter un Utilisateur;
                     </a>
                  </li>'; ?>
                  <?php echo ($this->Session->user('role')!=='adm_principal')? '<li hidden>
                    <a onclick="return confirm("Voulez-vous vraiment consulter la fréquentation du site?");" href="<?php echo Router::url("users/printers_frequence_user/".$this->Session->user("role"));?>">
                       👉 Consulter les fréquentations du site;
                     </a>
                  </li>':'<li>
                    <a onclick="return confirm("Voulez-vous vraiment consulter la fréquentation du site?");"  href="'.Router::url('users/printers_frequence_user/'.$this->Session->user('role')).'">
                       👉 Consulter les fréquentation du site;
                     </a>
                  </li>'; ?>
                  <?php echo ($this->Session->user('role')!=='adm_principal')? '<li hidden>
                    <a onclick="return confirm("Voulez-vous consulter les actions effectuées par les Users du site?");" href="<?php echo Router::url("users/printers_action_user/".$this->Session->user("role"));?>">
                       👉 Consulter les actions du site;
                     </a>
                  </li>':'<li>
                    <a onclick="return confirm("Voulez-vous consulter les actions effectuées par les Users du site?");"  href="'.Router::url('users/printers_action_user/'.$this->Session->user('role')).'">
                       👉 Consulter les actions du site;
                     </a>
                  </li>'; ?>
                  <?php echo ($this->Session->user('role')!=='adm_principal')? '<li>
                    <a href="'.Router::url('webroot/archivages_courriers/').'">
                       👉 Accèder au dossier du site;
                     </a>
                  </li>':'<li>
                    <a href="'.Router::url('webroot/archivages_courriers/').'">
                       👉 Accèder au dossier du site;
                     </a>
                  </li>'; ?>
                </ul>
              </p>
            </div>
          </div>
<!-- ------------Les Suites reservées à l'admin principal---------------------------- -->



        </div>
      </div>
    </section><!-- End Services Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->