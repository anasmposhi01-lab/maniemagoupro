<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> <?php echo isset($title_for_layout)?$title_for_layout:'Archives' ;?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link  href="<?php echo Router::url('webroot/assets/img/Icon_nyu.png');?>" rel="icon">
  <link href="<?php echo Router::url('webroot/assets/img/apple-touch-icon.png');?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo Router::url('webroot/assets/vendor/aos/aos.css');?>" rel="stylesheet">
  <link href="<?php echo Router::url('webroot/assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
  <link href="<?php echo Router::url('webroot/assets/vendor/bootstrap-icons/bootstrap-icons.css');?>" rel="stylesheet">
  <link href="<?php echo Router::url('webroot/assets/vendor/boxicons/css/boxicons.min.css');?>" rel="stylesheet">
  <link href="<?php echo Router::url('webroot/assets/vendor/glightbox/css/glightbox.min.css');?>" rel="stylesheet">
  <link href="<?php echo Router::url('webroot/assets/vendor/remixicon/remixicon.css');?>" rel="stylesheet">
  <link href="<?php echo Router::url('webroot/assets/vendor/swiper/swiper-bundle.min.css');?>" rel="stylesheet">
  <link href="<?php echo Router::url('webroot/assets/css/style_password.css');?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo Router::url('webroot/assets/css/style.css');?>" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: Presento - v3.7.0
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <div>
        <p><a href="<?php echo Router::url('gestionnaire/acceuil_admin');?>">
          <img src="<?php  echo Router::url('webroot/logo_1.jpg');?>" height="120px" widh="32px" alt="">
        </a></p>
      </div>
      <h1 class="logo me-auto"><a href="<?php echo Router::url('gestionnaire/acceuil_admin');?>">ARCHIVES/GOUPRO/MMA<span>.</span></a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
<!--------------------------------------------------------------------------------------------------------------------------------------------->
          <li class="dropdown"><a href="#"><span><span><i class="bi bi-file-earmark-word-fill"></i> Courriers Entrants/Orientés</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li class="dropdown"><a href="#"><span><i class="bx bx-map"></i> Courriers Entrants</span> <i class="bi bi-chevron-right"></i></a>
                   <ul>
             <!-------------------------------------------------------->
                        <li>          
                          <a onclick="return confirm('Voulez-vous enrégistrer un nouveau courrier entrant dans le Serveur?');" href="<?php echo Router::url('uploader/courriers_entrants/'.$this->Session->user('role'));?>">
                               📜 créer
                          </a>
                        </li>
              <!-------------------------------------------------------->
                        <li>          
                          <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire courriers entrants déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_courriers_entrants/'.$this->Session->user('role'));?>">
                               📙 Annuaire
                          </a>
                        </li>
                    </ul>
                </li>
              <!-------------------------------------------------------->
              <li class="dropdown"><a href="#"><span><i class="bx bx-map"></i> Courriers Entrants Orientés</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a onclick="return confirm('Voulez-vous enrégistrer un nouveau Courrier Orienté dans le Serveur?');" href="<?php echo Router::url('uploader/courriers_entrants_orientes/'.$this->Session->user('role'));?>">📜 créer</a></li>
                  <li><a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Courriers Orientés déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_courriers_entrants_orientes/'.$this->Session->user('role'));?>">📙 Annuaire</a></li>
                </ul>
              </li>
             <!----------------- Fin  li --------------------------------------->
            </ul>
          </li>
<!--------------------------------------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------------------------->
          <li class="dropdown"><a href="#"><span><i class="bi bi-file-earmark-word"></i> Courriers Sortants/AR/OM</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span><i class="bx bx-envelope"></i> Courriers Sortants</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
<!-------------------------------------------------------->
                      <li>          
                        <a onclick="return confirm('Voulez-vous enrégistrer un nouveau courrier sortant dans le Serveur?');" href="<?php echo Router::url('uploader/courriers_sortants/'.$this->Session->user('role'));?>">
                             📜 créer
                        </a>
                      </li>
                      <!-------------------------------------------------------->
                      <li>          
                        <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire Courriers Sortants déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_courriers_sortants/'.$this->Session->user('role'));?>">
                             📙 Annuaire
                        </a>
                      </li>
                </ul>
              </li>
              <!-------------------------------------------------------->
              <li class="dropdown"><a href="#"><span><i class="bx bx-envelope"></i> Accusés Réception</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a onclick="return confirm('Voulez-vous enrégistrer un nouveau accusé de reception dans le Serveur?');" href="<?php echo Router::url('uploader/accuse_reception/'.$this->Session->user('role'));?>">📜 créer</a></li>
                  <li><a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Accusés de réceptions déjà enrôlé?');" href="<?php echo Router::url('printers/annuaire_accuses_de_reception/'.$this->Session->user('role'));?>">📙 Annuaire</a></li>
                </ul>
              </li>
              <!-------------------------------------------------------->
              <li class="dropdown"><a href="#"><span><i class="bx bx-envelope"></i> Ordres de Mission</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a onclick="return confirm('Voulez-vous enrégistrer un nouveau Ordre de Mission dans le Serveur?');" href="<?php echo Router::url('uploader/ordre_mission/'.$this->Session->user('role'));?>">📜 créer</a></li>
                  <li><a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Ordres de Mission déjà enrôlés?');" href="<?php echo Router::url('printers/annuaire_ordre_mission/'.$this->Session->user('role'));?>">📙 Annuaire</a></li>
                </ul>
              </li>
             <!-------------------------------------------------------->
              <li class="dropdown"><a href="#"><span><i class="bx bx-envelope"></i> Commissions d'Affectation</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a onclick="return confirm('Voulez-vous enrégistrer une nouvelle Commission d\'Affectation dans le Serveur?');" href="<?php echo Router::url('uploader/comm_affectation/'.$this->Session->user('role'));?>">📜 créer</a></li>
                  <li><a onclick="return confirm('Voulez-vous accèder à l\'Annuaire de Commissions d\'Affectation déjà enrôlées?');" href="<?php echo Router::url('printers/annuaire_comm_affectation/'.$this->Session->user('role'));?>">📙 Annuaire</a></li>
                </ul>
              </li>
             <!----------------- Fin  li --------------------------------------->

            </ul>
          </li>
<!--------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------->
          <li class="dropdown"><a href="#"><span><i class="bi bi-mortarboard-fill"></i> Les Arrêtés</span> <i class="bi bi-chevron-down"></i></a>
            <ul>

             <!-------------------------------------------------------->
              <li>          
                <a onclick="return confirm('Voulez-vous  enrégistrer un nouveau arrêté dans le Serveur?');" href="<?php echo Router::url('uploader/arretes/'.$this->Session->user('role'));?>">
                     📜 créer
                </a>
              </li>
              <!-------------------------------------------------------->
              <li>          
                <a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Arrêtés déjà enrôlée?');" href="<?php echo Router::url('printers/annuaire_arretes/'.$this->Session->user('role'));?>">
                     📙 Annuaire
                </a>
              </li>
              <!-------------------------------------------------------->
            </ul>
          </li>
<!--------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------->
          <li class="dropdown"><a href="#"><span><i class="bi bi-person-workspace"></i> Réunions/Discours</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span><i class="bx bx-envelope"></i> Réunions </span> <i class="bi bi-chevron-right"></i></a>
                <ul>
             <!-------------------------------------------------------->
                        <li>          
                          <a onclick="return confirm('Voulez-vous enrégistrer une nouvelle dans le Serveur?');" href="<?php echo Router::url('uploader/reunion_uploader/'.$this->Session->user('role'));?>">
                               📜 créer
                          </a>
                        </li>
                        <!-------------------------------------------------------->
                        <li>          
                          <a onclick="return confirm('Voulez-vous accèder à l\'annuaire de Discours dans le Serveur?');" href="<?php echo Router::url('printers/annuaire_reunion/'.$this->Session->user('role'));?>">
                               📙 Annuaire
                          </a>
                        </li>
                  </ul>
                </li>
              <!-------------------------------------------------------->
              <li class="dropdown"><a href="#"><span>🎬 Les Discours </span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a onclick="return confirm('Voulez-vous enrégistrer un nouveau Discours dans le Serveur?');" href="<?php echo Router::url('uploader/discours/'.$this->Session->user('role'));?>">📜 créer</a></li>
                  <li><a onclick="return confirm('Voulez-vous accèder à l\'Annuaire des Discours de Son Exc.Gouverneur?');" href="<?php echo Router::url('printers/annuaire_discours/'.$this->Session->user('role'));?>">📙 Annuaire</a></li>
                </ul>
              </li>
             <!----------------- Fin  li --------------------------------------->
            </ul>
          </li>
<!--------------------------------------------------------------------------------------------------------------------------------------------->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a onclick="return confirm('Voulez-vous vraiment quitter l\'Application?');" href="<?php echo Router::url('users/logout/');?>" class="get-started-btn scrollto"> ❌ Quiter</a>
    </div>
  </header><br><br>
  <main id="mainnnn"><br><br>
      <?php
         echo $content_for_layout; 
      ?>
  </main><!-- End #main -->

<!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Notre Adresse<span>.</span></h3>
            <p>Avenue Kilima N°1,
              Quartier Kasuku <br>
              Commune Kasuku, Ville de Kindu<br>
              Maniema\ RD_Congo <br><br>
            </p>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h3>Les territoires</h3>
              ⚫ Kaïlo⚫ Punia
              ⚫ Lubutu <br>⚫ Kibombo
              ⚫ Kasongo⚫ Kabambarebr <br>⚫ Pangi
          </div>
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h3>Nous contacter<span>.</span></h3>
              <strong>⚫ Téléphones:</strong> +243 813266859, 998886710, 994203644<br>
              <strong>⚫ E-mail:</strong> anasmpshi01@gmail.com, maniemaokapi2022@gmail.com,gouvernorat@maniema.gouv.cd<br>
              <strong>⚫ Site_Web:</strong> www. maniema.gouv.cd<br>
          </div>
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>GouPro_MMA</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/presento-bootstrap-corporate-template/ -->
          Designed by <a href="https://maniema.gouv.cd/">Anastas Tshisele Ntende Assistant Informatique du Gouverneur de Province/Contact: +243 813266859</a>
        </div>
      </div>
      <div class="social-links text-center text-md-end pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files --> <?php // echo Router::url('webroot/assets/js/main.js');?>
  <script src="<?php echo Router::url('webroot/assets/vendor/purecounter/purecounter.js');?>"></script>
  <script src="<?php echo Router::url('webroot/assets/vendor/aos/aos.js');?>"></script>
  <script src="<?php echo Router::url('webroot/assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <script src="<?php echo Router::url('webroot/assets/vendor/glightbox/js/glightbox.min.js');?>"></script>
  <script src="<?php echo Router::url('webroot/assets/vendor/isotope-layout/isotope.pkgd.min.js');?>"></script>
  <script src="<?php echo Router::url('webroot/assets/vendor/swiper/swiper-bundle.min.js');?>"></script>
  <script src="<?php echo Router::url('webroot/assets/vendor/php-email-form/validate.js');?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo Router::url('webroot/assets/js/main.js');?>"></script>

</body>

</html>