 <main id="main">
    <!-- ======= Portfolio Details Section ======= -->
    <section  class="breadcrumbs">
      <div  class="container"><br><br>
        <h2 style="">BIENVENUE DANS LE GESTIONNAIRE DE COURRIERS DU GOUVERNEMENT PROVINCIAL DU MANIEMA</h2>
        <i>Une Application Pour une meilleure Gestion de Courriers en temps réel<li>
      </div>
    </section><!-- End Breadcrumbs -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        
        <div class="row gy-4">
               <div class="col-lg-4">
                   <div class="portfolio-details-slider swiper">
                         <div  class="swiper-wrapper align-items-center">

                                  <div class="swiper-slide">
                                    <img  style="background-attachment: revert-layer;" src="<?php  echo Router::url('webroot/logo_1.jpg');?>" alt="">
                                  </div>
                                  <!------------------------------------------------------------>
                                  <div class="swiper-slide">
                                  <img src="<?php  echo Router::url('webroot/logo_1.jpg');?>" alt="">
                                  </div>
                                  <!------------------------------------------------------------>
                        </div>
                   <div class="swiper-pagination"></div>
               </div>
        </div>
        <!------------------------------------------------------------>
        <div class="col-lg-4">
            <div >
              <h4><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></h4>
             <center><h3  style="text-align: center;">Connexion <br> au <br> Gestionnaire de Courriers</h3></center> 
             <center>🎇🎇🎇🎇🎇🎇🎇🎇🎇🎇🎇🎇🎇</center> 
            <form method="post" action="<?php echo Router::url('users/login'); ?>" enctype="multipart/form-data">
              <div class="my-3">
                <div class="loading">
                  Entrez votre Nom Utilisateur
                  <input   class="form-control" type="text" name="nom" value="" placeholder="Entrez votre nom d'utilisateur">
                </div><br>
                <div   class="loading">

                    <div class="loading">
                      Entrez votre mot de Passe
                         <input class="form-control"  type="password" name="pass" value="" placeholder="Entrez votre mot de passe">     
                     <div class="anas">                         
                         <svg xmlns="http://www.w3.org/2000/svg" style="margin: 0; padding: 0; cursor: pointer;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>

                         <svg xmlns="http://www.w3.org/2000/svg" style="display: none; cursor: pointer;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                     </div>
                    </div>
                </div>

<!------------------------------------------------------------------------------------------------------>
              </div><br><br>
              <div class="text-center"><button  class="btn btn-info btn-lg text-white px-5 py-2" type="submit">Connexion</button></div>
              <div class="entry-content">                     
              <div class="read-more"   style="text-align: center;">
                <a onclick="return confirm('Avez-vous  oublié votre mot de passe?');" href="<?php echo Router::webroot('users/.....'); ?>">Mot de passe ou nom d'accès oublié? &rarr; </a>
              </div>
              </div>
            </form>
            </div>
            <div class="portfolio-description">
              <h2>Contexte de ce logiciel</h2>
              <p style="text-align: justify;">
                Le Gestionnaire des Courriers est conçu dans l'objectif de numériser le fonctionnement et Gestion de tous les Courriers reçus et envoyés par le Gouvernement Provincial du Maniema, afin d'assurer une interaction permanante et ininterrompue. Une gestion d'une base de données relationnelles: sa consultation online, redaction et un uploader permenant pour tout user permis. Pour toute complication dans sa gestion: <br>Contactez-nous au +243 8132 66 859
              </p>
            </div>
          </div>
         <!------------------------------------------------------------------------------------>
        <!------------------------------------------------------------>
        <div class="col-lg-4">
            <div >
                                  <!------------------------------------------------------------>
            <div class="portfolio-description">
              <h2  style="text-align: center;"> <br>Présentation <br> de la <br> Province du Maniema</h2>
              <h5 style="text-align: center;">********************************</h5><wbr>
                    <div   style="text-align: center;">
                      <p><a href="">
                        <img src="<?php  echo Router::url('webroot/img/carte_maniema.jpg');?>" height="205px" widh="64px" alt="">
                      </a></p>
                    </div>
              <br><p style="text-align: justify;">
                Le Maniema est une Province de l'Est de la République Démocratique du Congo (RDC), riche en ressources minières (or, cuivre, cobalt, diamant), avec pour Chef-lieu la ville de Kindu. Créée en 1988, elle est divisée en plusieurs territoires (Kabambare, Kailo, Kasongo, Kibombo, Lubutu, Pangi, Punia) et fait face à des défis humanitaires liés à l'insécurité, aux conflits armés et aux violences sexuelles, malgré son potentiel économique.  <br>Contactez-nous au +243 8132 66 859
              </p>
            </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->
  </main><!-- End #main -->
  <style>
    label {
  position: relative;
}
label input {
  font-size: 1em;
  background: transparent;
  color: #f9f9f9;
  border: 2px solid #7a7a7a;
  border-radius: 5px;
  padding: 1rem 1.2rem;
  width: 350px;
  transition: all 0.2s;
}

label input:focus {
  border-color: #ff4754;
}

label .password-icon {
  display: flex;
  align-items: center;
  position: absolute;
  top: 50%;
  transform: translateY(-50px);
  width: 20px;
  color: #f9f9f9;
  transition: all 0.2s;
  right: 20px;
}

label .password-icon .feather-eye-off {
  display: none;

}

label .password-icon:over {
  cursor: pointer;
  color: #ff4754;
  
}
  </style> 