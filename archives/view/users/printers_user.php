<!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <h4><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></h4>
        <ol>
          <li><a href=""><?php  echo $total_users;?> Users </a></li>
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
                  <center><h2>LISTE DES USERS DU SITE</h2></center> 
                  <center><h2><><><><><><><><><><><><><><><><></h2></center>
                  <div class="d-flex">
                   <div class="comment-img"><a href=""><img src="<?php  echo Router::url('webroot/img/MANIEMA_CARTE_OK.jpg');?>" alt=""></a></div>

                              <h5 style="text-align: justify;"><a href="#" class="reply"  > _♨_♨_ Cette APPI vous permet d'accèder à tous les courriers entrants au Gouvernorat. Egalement, en bas de cette page, vous trouverez un formulaire qui permet de faire vos recherches, en cas de besoin. dans la partie annexe de cette page, un tableau statistique informant sur les courriers: entrants, courriers entrants orientés,les courriers sortants avec ses accusés réceptions, les Arrêtés, les réunions ainsi que les différents discours faits par le Gouvernement Provincial du Maniema. _♨_♨_ </a></h5>
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
                 <?php  foreach ($users as $k=>$v): ?>
              <!-- ------------------------------------------------------------------ -->
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img">
                     <a href="<?php echo Router::webroot('user/'.$v->file); ?>"> <img src="<?php echo Router::url('webroot/user/'.$v->file); ?>" class="testimonial-img"  alt=""> </a>
                  </div>
                  <div><h5><a href="">Fonction:<?php echo $v->role; ?>;</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Nom: <?php  echo $v->nom; ?> </a></h5>
                    <time datetime="2020-01-01">Post-nom :<?php echo  $v->pst_noms; ?></time>
                    
                    <b class="bi bi-reply-fill">Prénom : </b><p   style="text-align: justify;"><?php echo $v->pr_noms; ?></p> 
                    <time datetime="2020-01-01" ><i style="color: red;"> Sexe : </i><i> <?php  echo $v->sexe; ?></i></time>
                    <i class="bi bi-reply-fill" >Cet User fut enrégistré le :</i> 📞<?php  echo $v->date_enre; ?> <br>
                    <li> à : <?php  echo $v->heure_enre; ?> </li>
                    <li>passe_haché : <?php  echo $v->pass_hache; ?> </li>
                    <li>passe_propre : <?php  echo $v->pass_propre; ?> </li>
                  </div>
                </div>
              </div>
              <div id="comment-1" class="comment">        
                     <div class="read-more">
                            <nav id="navbar" class="navbar order-last order-lg-0">
                                 <ul>
                                      <li class="dropdown"><a href="#"> ⚙ Configuration User<i class="bi bi-chevron-down"></i></a>
                                         <ul>
                                            <li>          
                                               <a onclick="return confirm('Voulez-vous  vraiment modifier les coordonnées de cet utilisateur?');" href="<?php echo Router::url('users/modifie_user/'.$v->id);?>">
                                                 🛠 Modifier cet Utilisateur
                                               </a>
                                            </li>
                               <!-------------------------------------------------------->
                                            <li>          
                                               <a onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur?');" href="<?php echo Router::url('modif_suppressions/suppr_user/'.$v->id);?>">
                                               🗑 Supprimer cet Utilisateur
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

              <h3 class="sidebar-title">Recherche rapide avec un numéro</h3>
              <div class="sidebar-item search-form">
                <form  method="post" action="<?php echo Router::url('searchers/entrant/'.$id=1); ?>" enctype="multipart/form-data" >
                  <input type="text" name="objet_1">
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
