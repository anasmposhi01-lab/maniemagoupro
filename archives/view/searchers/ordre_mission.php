<!-- ======= Breadcrumbs ======= -->

    <section class="breadcrumbs">
      <div class="container">
                            <center>  
                                     <div>
                                         <a  href="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>">
                                           <img  class="anas1" src="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>"  alt="">
                                         </a>
                                     </div>
                                         <a  href=""><?php echo $this->Session->user('nom'); ?></a>

                                     <h4><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></h4>
                                     <ol>
                                       <li><a href=""><?php  echo $total_OR;?></a></li>
                                       <li>Ordres de Mission dont le dernier Numéro est N°: 
                                              <span><b style="color:blue;"><?php echo  $end_file->num; ?></b></span><a href="<?php echo Router::webroot('ordres_missions/'.$end_file->file); ?>"> <span>👉<b style="color:red;">Télécharger &rarr; </b></span></a>
                                       </li>
                                     </ol>

                            </center>
      
    </section><!-- End Breadcrumbs -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
              <div class="blog-comments">
                <div id="comment-1" class="comment">
                  <center><h2>REPERTOIRE DES ORDRES DE MISSION DU GOUVERNEMENT PROVINCIAL DU MANIEMA</h2></center> 
                  <center><h2><><><><><><><><><><><><><><><><></h2></center>
                  <div class="d-flex">
                   <div class="comment-img"><a href="<?php  echo Router::url('webroot/img/carte_maniema.jpg');?>"><img src="<?php  echo Router::url('webroot/img/carte_maniema.jpg');?>" alt=""></a></div>

                              <h5 style="text-align: justify;"><a href="#" class="reply"  > _♨_♨_ Cette page vous permet d'accèder à tous les Ordres de Mission du Gouvernement Provincial du Maniema. Egalement, en bas de cette page, vous trouverez un formulaire qui permet de faire vos recherches, en cas de besoin. dans la partie annexe de cette page, un tableau statistique informant sur les courriers: entrants, courriers entrants orientés,les courriers sortants avec ses accusés réceptions, les Arrêtés, les réunions ainsi que les différents discours faits par le Gouvernement Provincial du Maniema. _♨_♨_ </a></h5>
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
                 <?php  foreach ($OR as $k=>$v): ?>
              <!-- ------------------------------------------------------------------ -->
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img">
                     <a href="<?php echo Router::webroot('ordres_missions/'.$v->file); ?>"> <img src="<?php echo Router::url('webroot/pdf.png'); ?>" class="testimonial-img"  alt=""> </a>
                  </div>
                  <div><h5><a href=""  style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;">N°<?php echo $v->num; ?></a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> signé le : <?php  echo $v->date_signature; ?> </a></h5>
                    <time datetime="2020-01-01">Destination :<?php echo  $v->destination; ?></time>
                    
                    <b class="bi bi-reply-fill">Objet : </b><p style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;"><?php echo $v->objet; ?></p> 
                    <time datetime="2020-01-01" ><i style="color: red;"> Nom du Titulaire Principal : </i><i  style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;"> <?php  echo $v->nom_titulaire_mission; ?></i></time>
                    <time datetime="2020-01-01" ><i style="color: red;"> Fonction du Titulaire Principal : </i><i  style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;"> <?php  echo $v->fonction_titulaire_mission; ?></i></time>
                    <i class="bi bi-reply-fill" >Cet Ordre de Mission a été enrégistré par nos services en date du :</i> <?php  echo $v->date_enr; ?> 
                    <i class="bi bi-reply-fill" >à :</i>⏰ <?php  echo $v->heure_enr; ?>  <br>
                  </div>
                </div>
              </div>
              <div id="comment-1" class="comment">        
                     <div class="read-more">
                            <nav id="navbar" class="navbar order-last order-lg-0">
                                 <ul>
                                      <li class="dropdown"><a href="#"> ⚙ Configuration de cet Ordre de Mission<i class="bi bi-chevron-down"></i></a>
                                         <ul>
                                            <li>          
                                               <a onclick="return confirm('Voulez-vous  vraiment modifier cet Ordre de Mission?');" href="<?php echo Router::url('modif_suppressions/modif_ordre_mission/'.$v->id);?>">
                                                 🛠 Modifier cet Ordre de Mission
                                               </a>
                                            </li>
                               <!-------------------------------------------------------->
                                            <li>          
                                               <a onclick="return confirm('Voulez-vous vraiment supprimer cet Ordre de Mission?');" href="<?php echo Router::url('modif_suppressions/suppr_ordre_mission/'.$v->id);?>">
                                               🗑 Supprimer cet Ordre de Mission
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
              <div class="entry-content" >        
                     <div class="read-more">
                         <a href="<?php echo Router::webroot('ordres_missions/'.$v->file); ?>">Télécharger &rarr; </a>
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
                <h4>Rechercher un Ordre de Mission</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form  method="post" action="<?php echo Router::url('searchers/ordre_mission/'); ?>" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="num"><strong><i>Numéro *</i></strong></option>
                                       <option value="objet"><strong><i>Objet *</i></strong></option>
                                       <option value="nom_titulaire_mission"><strong><i>Nom Titulaire de la Mission *</i></strong></option>
                                       <option value="fonction_titulaire_mission"><strong><i>Fonction Titulaire de la Mission *</i></strong></option>
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
                <form  method="post" action="<?php echo Router::url('searchers/ordre_mission/'.$id=1); ?>" enctype="multipart/form-data" >
                  <input type="text"  name="objet_1">
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
