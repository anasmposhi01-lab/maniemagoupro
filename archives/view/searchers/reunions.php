
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>LES REUNIONS DU GOUVERNEMENT PROVINCIAL DU MANIEMA</h2>
            <center>
                 <a  href="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>">
                   <img  class="anas1" src="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>"  alt="">
                 </a>
                 <a  href="" style="color: white;">User Connecté:<?php echo ' ✔ '.$this->Session->user('nom'); ?></a>  
            </center>
            <h4><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></h4>
        </div>
      </div>

    </section><!-- End Services Section -->
<!----------------------------------------------------------->
<!-- ======= Breadcrumbs ======= -->

    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

<!-- ------------------------------------------------------------------ -->
            <div class="blog-comments">                 
                 <?php foreach ($reunion as $k=>$v): ?>
              <!-- ---------------------
                      ---------------------------------------- -->
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><a href=""><img src="<?php echo Router::url('webroot/img/carte_maniema.jpg'); ?>" class="testimonial-img"  alt=""></a></div>
                  <div>
                    <h5><a href="">📆 Réunion du <?php echo $v->date; ?>*</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> <h4><?php  echo 'Réunion présidée par  <b style="font-family:Helvetica,Arial,sans-serif;text-transform: uppercase;">« '. $v->fonction.' »</b>; ';?></h4><h4>Lieu<?php echo ': <b>« '.$v->lieu_reunion.' »</b>'; ?></h4> <br></a></h5>
                    
                    <b class="bi bi-reply-fill"> <u>Objet de la Réunion</u>: </b><p   style="text-align: justify;font-family:Helvetica,Arial,sans-serif;text-transform: uppercase;"><?php echo $v->objet; ?></p> 
                    
                    <time datetime="2020-01-01">Fait ce <?php echo  ': '.$v->date_enre; ?><?php echo  ' à: '.$v->heure_enre; ?></time> 
                  </div>
                </div>
              </div>
              <div id="comment-1" class="comment">        
                     <div class="read-more">
                            <nav id="navbar" class="navbar order-last order-lg-0">
                                 <ul>
                                      <li class="dropdown"><a href="#"> ⚙ Paramètres<i class="bi bi-chevron-down"></i></a>
                                         <ul>
                                            <li>      
                                               <a onclick="return confirm('Voulez-vous  vraiment ajouter un nom d\'un Participant à cette Réunion?');" href="<?php echo Router::url('uploader/reunion_ajout_part/'.$v->id);?>">
                                                 <h1>1. ✍ Ajouter un participant</h1> 
                                               </a>
                                            </li>
                                            <li>       
                                               <a onclick="return confirm('Voulez-vous  ajouter le Résumé des Points discutés, Faits importants et Décisions prises?');" href="<?php echo Router::url('uploader/reunion_discussions/'.$v->id);?>">
                                                 <h1>2. ✍ Points discutés, Faits importants et Décisions</h1> 
                                               </a>
                                            </li>
                                            <li>         
                                               <a onclick="return confirm('Voulez-vous  vraiment ajouter les décisions prises, Recommandations et actions à entreprendre?');" href="<?php echo Router::url('uploader/reunion_decisions_et_recommandations/'.$v->id);?>">
                                                 <h1>3. ✍ Recommandations et Actions à entreprendre </h1>
                                               </a>
                                            </li>
                                            <li>      
                                               <a onclick="return confirm('Voulez-vous  vraiment ajouter les Personnes responsables des actions à entreprendre et Échéances pour la réalisation des actions?');" href="<?php echo Router::url('uploader/reunion_responsEcheances/'.$v->id);?>">
                                                 <h1>4. ✍ Personnes Responsables des Actions à Entreprendre et Échéances</h1>
                                               </a>
                                            </li>
                                            <li>    
                                               <a onclick="return confirm('Voulez-vous  vraiment Prochaines ajouter les étapes et réunions de suivi/ Personne responsable du suivi?');" href="<?php echo Router::url('uploader/reunion_suivi/'.$v->id);?>">
                                                 <h1>5. ✍ Prochaines Etapes et Réunions de suivi</h1> 
                                               </a>
                                            </li>
                                            <li>          
                                               <a onclick="return confirm('Voulez-vous  vraiment modifier l\'identité de ce Participant?');" href="<?php echo Router::url('modif_suppressions/modif_reunion/'.$v->id);?>">
                                                 <h1>6. 🛠 Modifier le Titre de cette Réunion</h1>
                                               </a>
                                            </li>
                                            <li>          
                                               <a onclick="return confirm('Voulez-vous vraiment supprimer ce Participant?');" href="<?php echo Router::url('modif_suppressions/suppression_participant/'.$v->id);?>">
                                               <h1>7. 🗑 Suprimer cette Réunion</h1>
                                               </a>
                                            </li>
                            <!-------------------------------------------------------->
                                          </ul>
                                      </li>
                                 </ul>
                           </nav>
<!--------------------------------------------------------------------------------------------------------------------------------------------->
                     </div><!-- End comment #1 -->
              </div>
              <div class="entry-content">        
                     <div class="read-more" >
                      <a  onclick="return confirm('Voulez-vous accèder au résumée du rapport pour cette cette réunion?');" href="<?php echo Router::url('printers/annuaire_rapport_reunion/'.$v->id);?>">📙 Rapport &rarr; </a>
                     </div>
              </div>
                <?php  endforeach; ?>
              <!-- ------------------------------------------------------------------ -->
             <p style="text-align: center;">
                      <?php
                          if($page>1){
                                       echo"<a href='?page=".($this->request->page-1)."'class='btn btn-danger'>Précédent</a>&nbsp";
                                     } 
                          for($i=1;$i<=$page;$i++){
                                      echo"<a href='?page=".$i."' class='btn btn-primary'>$i</a>&nbsp;";}
                                      if($i>$this->request->page){
                                      echo"<a href='?page=".($page+1)."' class='btn btn-danger'>Suivant</a>&nbsp;";}
                      ?>
             </p> 
<!-- ------------------------------------------------------------------ -->
              <div class="reply-form">
                <h4>Rechercher Une Réunion</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form   method="post" action="<?php echo Router::url('searchers/reunions/'); ?>" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="objet"><strong><i>Titre de la Réunion *</i></strong></option>
                              </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea  style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;" name="objet_1" class="form-control" placeholder="Entrez votre  Référence *"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Trouver</button>

                </form>

              </div>

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Recherche</h3>
              <div class="sidebar-item search-form">
                <form   method="post" action="<?php echo Router::url('searchers/reunions/'); ?>" enctype="multipart/form-data" >
                  <input type="text" name="objet_1">
                  <input hidden type="text" name="mode" value="objet">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Catégories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <h3><u>Statistique de Courriers</u></h3>
                  <li>✔<a href="<?php  echo Router::url('printers/annuaire_courriers_entrants/'.$this->Session->user('role'));?>">Total Courriers entrants : <span>(<?php   echo $total_entrants;?>) Courriers</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/annuaire_courriers_sortants/'.$this->Session->user('role'));?>">Total Courriers sortants : <span>(<?php echo $total_sortants;?>) Courriers</a></span></li>                  
                  <li>✔<a href="<?php  echo Router::url('printers/annuaire_courriers_entrants_orientes/'.$this->Session->user('role'));?>">Total Courriers Orientés : <span>(<?php   echo $total_orientes;?>) Courriers</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/annuaire_accuses_de_reception/'.$this->Session->user('role'));?>">Total Accusés de Réception : <span>(<?php echo $total_accuses;?>) Courriers</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/annuaire_arretes/'.$this->Session->user('role'));?>">Total Arrêtés : <span>(<?php echo $total_arret;?>) Arrêtés</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/liste_presence_reunion_gouv/'.$this->Session->user('role'));?>">Total des Réunions : <span>(<?php echo $total_reunion;?>)  tenues</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/annuaire_arretes/'.$this->Session->user('role'));?>">Total Arrêtés : <span>(<?php echo $total_arret;?>) Arrêtés</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/annuaire_discours/'.$this->Session->user('role'));?>">Total des Discours : <span>(<?php echo $total_discours;?>)</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/annuaire_ordre_mission/'.$this->Session->user('role'));?>">Total des Ordres de Mission signé : <span>(<?php echo $total_OR;?>)</a></span></li>
                  <li>✔<a href="<?php echo Router::url('printers/annuaire_comm_affectation/'.$this->Session->user('role'));?>">Total des Commissions d'Affectations signées : <span>(<?php echo $total_comm_affect;?>)</a></span></li>

                </ul>
              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Recentes Discutions</h3>
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  <img src="assets/img/blog/blog-recent-1.jpg" alt="">
                  <h4><a href="blog-single.html">Focal 1</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog/blog-recent-2.jpg" alt="">
                  <h4><a href="blog-single.html">Focal 2</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog/blog-recent-3.jpg" alt="">
                  <h4><a href="blog-single.html">Focal 3</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog/blog-recent-4.jpg" alt="">
                  <h4><a href="blog-single.html">Focal 4</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog/blog-recent-5.jpg" alt="">
                  <h4><a href="blog-single.html">Focal 5</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Statistique de Fréquentation de l'App</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->


<!--- =================================================================================================================================--->