
  <main id="main">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>LES REUNIONS DU GOUVERNEMENT PROVINCIAL DU MANIEMA</h2>
          <p>
            <i class="bi bi-chevron-double-left"></i><b><strong><?php  echo 'Objet de la Réunion: '.$reunion->objet;?>.</strong> </b><i class="bi bi-chevron-double-right"></i><br> 
            <?php echo 'Réunion tenue au '.$reunion->lieu_reunion; ?>
              <?php  echo ', en date du '.$reunion->date; ?>
              <?php  echo '. Elle a été présidée par : '. $reunion->fonction;?>
          </p><br>          
        <div class="row">
          <div class="col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <i class="bi bi-briefcase"></i>
              <h4><a href="#">1. RESUME DES DISCUSSIONS</a></h4>
              <p>Lors de cette séance du Travail, deux points essentiels résument les closes de Discussion, il s'agigit nottament de:<br>
                <u>----------------</u>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-lightning-charge-fill"></i><b>Résumé des points discutés:</b></li>
                  👉🏻<?php echo $discution->faits_discutes; ?>
                  <li><i class="bi bi-lightning-charge-fill"></i><b>Faits importants et décisions prises:</b></li>
                  👉🏻<?php echo $discution->faits_imports; ?>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-card-checklist"></i>
              <h4><a href="#">2. DECISIONS ET RECOMMANDATIONS</a></h4>
              <p>Lors de de tenue de cette Réunion, trois points essentiels résument les closes de Discussion, il s'agigit nottament de:<br>
                <u>----------------</u>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-lightning-charge-fill"></i><b>Liste des décisions prises:</b></li>
                  👉🏻<?php echo $recommandation->decisions_prises; ?>
                  <li><i class="bi bi-lightning-charge-fill"></i><b>Recommandations formulées:</b></li>
                  👉🏻<?php echo $recommandation->recommandations; ?>
                  <li><i class="bi bi-lightning-charge-fill"></i><b>Les actions à entreprendre:</b></li>
                  👉🏻<?php echo $recommandation->actions_entreprendre; ?>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-bar-chart"></i>
              <h4><a href="#">3. RESPONSABILITES ET ECHEANCES</a></h4>
              <p>Lors de cette séance du Travail, deux points essentiels résument les closes de Discussion, il s'agigit nottament de:<br>
                <u>----------------</u>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-lightning-charge-fill"></i><b>Personnes responsables des actions à entreprendre:</b></li>
                    👉🏻<?php echo $echeances_ren->responsabilites; ?>
                  <li><i class="bi bi-lightning-charge-fill"></i><b>Échéances pour la réalisation des actions:</b></li>
                    👉🏻<?php echo $echeances_ren->echeances; ?>
                  
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-binoculars"></i>
              <h4><a href="#">4. SUIVI</a></h4>
              <p>Pour un suivi efficient, trois points essentiels sont retenus, il s'agigit nottament de:<br>
                <u>----------------</u>
                <ul style="margin-left: 1px;p">
                  <li>👉🏻<b>Prochaines étapes et réunions de suivi:</b></li>
                  <?php echo $les_suivis->Prochaines_Etapes; ?><br>
                  <li>👉🏻<b>Prochaines reunions:</b></li>
                  <?php echo $les_suivis->prochaines_reunions; ?><br>
                  <li>👉🏻<b>Personne responsable du suivi:</b></li>
                  <?php echo $les_suivis->Personnes_Charge_suivi; ?>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-brightness-high"></i>
              <h4><a href="#">5. LISTE DE PARTICIPANTS A CETTE REUNION</a></h4>
              <p>Lors de cette Réunion, ont pris part à cette séance du Travail, il s'agigit nottament de:<br>
                <u>----------------</u>
                <ul style="margin-left: 50px;">
                  <li><i class="bi bi-brush-fill "></i>
                    <?php echo ($les_participants->sexe=='homme')? ' Monsieur':'<a style="color: red;">Madame </a>'; ?>
                    <?php echo $les_participants->nom.' - '.$les_participants->post_nom.' - '.$les_participants->prenom.': '.$les_participants->fonction; ?></li>
                </ul>
              </p>
            </div>
          </div>
         <!------//=============================================================================---->

        </div>


      </div>
    </section><!-- End Services Section -->
  </main><!-- End #main --> 

