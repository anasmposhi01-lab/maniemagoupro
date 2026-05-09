<!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
                                       <li><a href=""><?php  echo $total_orientes;?></a></li>
                                       <li>Courriers entrants Orientés dont le dernier Numéro est N°: 
                                              <span><b style="color:blue;"><?php echo $end_file->num_c; ?></b></span><a href="<?php echo Router::webroot('courriers_orientes/'.$end_file->file); ?>"> <span>👉<b style="color:red;">Télécharger &rarr; </b></span></a>
                                       </li>
        </ol>
        <h2>Repertoire d'un ou des courriers entrants Orientés recherché(s)</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

<!-- ------------------------------------------------------------------ -->
            <div class="blog-comments">                 
                 <?php  foreach ($orientes as $k=>$v): ?>
              <!-- ------------------------------------------id, num_c, objet, nom_sign, date_rient, Exploitant, gouv_orient, type, file------------------------ -->
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><a href="<?php echo Router::webroot('courriers_orientes/'.$v->file); ?>"><img src="<?php  echo Router::url('webroot/pdf.png');?>" alt=""></a></div>
                  <div>
                    <h5><a href="">N°<?php echo $v->num_c; ?></a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Orienté à: <?php  echo $v->Exploitant; ?> </a></h5><time datetime="2020-01-01">Date d'orientation :<?php echo  ' '.$v->date_rient; ?></time>
                    
                    <b class="bi bi-reply-fill">Objet : </b><p   style="text-align: justify;"><?php echo $v->objet; ?></p>
                    <time datetime="2020-01-01">Date d'enrégistrement de ce Courrier :<?php echo  ' '.$v->date_enre; ?></time>
                    <time datetime="2020-01-01">Heure d'enrégistrement de ce Courrier :<?php echo  ' '.$v->heure_enre; ?></time> 
                  </div>
                </div>
              </div>
              <div class="entry-content">        
                     <div class="read-more">
                         <a href="<?php echo Router::webroot('courriers_orientes/'.$v->file); ?>">Télécharger &rarr; </a>
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
                <h4>Rechercher Un Courrier Entrant-Orienté</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form   method="post" action="<?php echo Router::url('searchers/oriente/'); ?>" enctype="multipart/form-data" >
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
                <form   method="post" action="<?php echo Router::url('searchers/oriente/'.$id=1); ?>" enctype="multipart/form-data" >
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
