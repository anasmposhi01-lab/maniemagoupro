<!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <h4><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></h4>
        <ol>
          <li><a href=""><?php  echo $total_action_users;?> Action déjà effectuées dans cette application</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
              <div class="blog-comments">
                <div id="comment-1" class="comment">
                  <center><h2>RAPPORT DES ACTIONS CLES EFFECTUEES DANS LE SERVEUR</h2></center> 
                  <center><h2><><><><><><><><><><><><><><><><></h2></center>
                  <div class="d-flex">
                   <div class="comment-img"><a href=""><img src="<?php  echo Router::url('webroot/img/MANIEMA_CARTE_OK.jpg');?>" alt=""></a></div>

                              <h5 style="text-align: justify;"><a href="#" class="reply"  > _♨_♨_ Cette page vous permet d'accèder à tous les courriers entrants au Gouvernorat. Egalement, en bas de cette page, vous trouverez un formulaire qui permet de faire vos recherches, en cas de besoin. dans la partie annexe de cette page, un tableau statistique informant sur les courriers: entrants, courriers entrants orientés,les courriers sortants avec ses accusés réceptions, les Arrêtés, les réunions ainsi que les différents discours faits par le Gouvernement Provincial du Maniema. _♨_♨_ </a></h5>
                   </div>
                </div>
               </div>
             </article>
            </div>
          </div>
       </div>
    </section>
    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
<!-- ------------------------------------------------------------------ -->
            <div class="blog-comments">                 
<?php  foreach ($action_users as $k=>$v): ?>
              <!-- ------------------------------------------------------------------ -->
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img">
                     <a href="<?php echo Router::webroot('courriers_entrants/'.$v->nom_file); ?>"> <img src="<?php echo Router::url('webroot/pdf.png'); ?>" class="testimonial-img"  alt=""> </a>
                  </div>
                  <div><h5><a href=""><?php echo $v->nom.' - '.$v->pst_noms.' - '.$v->pr_noms.'; dont Foction:'.$v->role ; ?></a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Action faite en date du: <?php  echo $v->date_action.' à :'.$v->heure_action.':'.$v->actions.', Type:'.$v->type.', dont le numéro:'.$v->num; ?> </a></h5>
                    <time datetime="2020-01-01">Commentaire :<?php echo  $v->commentaire_action; ?></time>
                    
                    <b class="bi bi-reply-fill">dont l'Objet : </b><p   style="text-align: justify;"><?php echo $v->objet; ?></p> 
                  </div>
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
                <h4>Rechercher un Courrier Entrant</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form  method="post" action="<?php echo Router::url('searchers/entrant/'); ?>" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="num"><strong><i>Numéro *</i></strong></option>
                                       <option value="objet"><strong><i>Objet *</i></strong></option>
                                       <option value="exp"><strong><i>Nom Expéditeur *</i></strong></option>
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
