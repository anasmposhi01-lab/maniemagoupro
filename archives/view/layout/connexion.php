 <!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> <?php echo isset($title_for_layout)?$title_for_layout:'Archive_Gouv_Maniema' ;?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link  href="<?php echo Router::url('webroot/icon_anas.gif');?>" rel="icon">
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

<body   style="argin: 0;height: 20vh;background-image: url('<?php echo Router::url('');?>');background-repeat: no-repeat;background-size: 100%;background-color: cover;">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
     <h1 class="logo me-auto"><a href="index.html">GESTIONNAIRE DE COURRIERS<span>📜.</span></a></h1>
      <a onclick="return confirm('Voulez-vous vraiment quitter cette Application?');" href="www.maniema.gouv.cd" class="get-started-btn scrollto">Quitter</a>
    </div>
  </header><!-- End Header -->
  

  <?php
         echo $content_for_layout; 
  ?>

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
          Designed by <a href="https://maniema.gouv.cd/">Anastas Tshisele Ntende Assistant Informatique du Gouverneur de Province +243 813266859</a>
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
  <!------------------------------------------->
  <script src="<?php echo Router::url('webroot/js/password.js');?>"></script> 

  <!-- Template Main JS File -->
  <script src="<?php echo Router::url('webroot/assets/js/main.js');?>"></script>

</body>

</html>