<!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
                            <center>  
                                     <div>
                                         <a  href="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>">
                                           <img  class="anas1" src="<?php echo Router::webroot('user/'.$this->Session->user('file')); ?>"  alt="">
                                         </a>
                                     </div>
                                         <a  href="" style="color: white;">User Connecté:<?php echo ' ✔ '.$this->Session->user('nom'); ?></a>
                            </center> 
        <h2 style="text-align: center;">BIENVENUE SUR LA PAGE QUI VOUS PERMET DE MODIFIER LE TITRE/OBJET DE LA REUNION</h2>
        <u style="color: red;"><center>*******************************************************************</center></u>
        <ol>
          <li><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></li>
          <li style="text-align: justify;">Cette page vous permet une modification d'une identité d'un participant à une réunion. Egalement, en bas de cette page, vous trouverez un formulaire qui permet de faire vos recherches, en cas de besoin. dans la partie annexe de cette page, un tableau statistique informant sur les courriers: entrants, courriers entrants orientés,les courriers sortants avec ses accusés réceptions, les Arrêtés, les réunions ainsi que les différents discours faits par le Gouvernement Provincial du Maniema.
          </li>
        </ol>
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

              <div id="comment-1" class="comment">

              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><a href=""><img src="<?php  echo Router::url('webroot/logo_1.jpg');?>" alt=""></a></div>
                  <div  class="comment-img">
                              <h5 style="text-align: justify;"><a href="#" class="reply"  > ♨_♨ Cette application offre son service qu'à la cellule informatique attachée au Bureau de Son Excellence Monsieur le Gouverneur de Province afin de faciliter, enrégistrement, consultation, modification et accès facile à tous les courriers reçus et ou signés par son Bureau. Le mécanisme d'accès y est alors stricte et des strictes mesures</a></h5>
                  </div>
                </div>
              </div>
              <!-- ------------------------------------------------------------------ -->
              <center><h4>Veuillez apporter vos modifications dans le formulaire ci-dessous 👇</h4></center> 
              <div class="reply-form">
                <form  method="post" action="<?php echo Router::url('modif_suppressions/modif_reunion/'); ?>" enctype="multipart/form-data">
                             <!------------------------------------------------------------------------>
                              <input hidden  class="form-control" type="text" name="id" value="<?php echo $modifie_reunion->id; ?>">
                              <input hidden  class="form-control" type="text" name="date_enre" value="<?php echo $modifie_reunion->date_enre; ?>">
                              <input hidden  class="form-control" type="text" name="heure_enre" value="<?php echo $modifie_reunion->heure_enre; ?>">
                              <input hidden  class="form-control" type="text" name="cle_parent" value="<?php echo $modifie_reunion->cle_parent; ?>">
                             <!----------------------------------------------------------------------------------------------------------------->
                  <div class="row">
                    <div class="col form-group">
                              <h3>✍ Veuiller modifier le lieu que se tiendra la réunion</h3>
                              <input  class="form-control" type="text" name="lieu_reunion" value="<?php echo $modifie_reunion->lieu_reunion; ?>">
                             <!-------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------------->
                              <h3>✍ Veuiller modifier la Fonction du tenant de la réunion</h3>
                              <input  class="form-control" type="text" name="fonction" value="<?php echo $modifie_reunion->fonction; ?>">
                             <!----------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------>
                              <h3>✍ Veuiller modifier la date de la tenue de la réunion</h3>
                              <input  class="form-control" type="text" name="date" value="<?php echo $modifie_reunion->date; ?>">
                             <!------------------------------------------------------------------>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------->
                              <h3>✍ Veuiller modifier l'Objet/Titre de cette réunion</h3>
                              <input  class="form-control" type="text" name="objet" value="<?php echo $modifie_reunion->objet; ?>">
                             <!------------------------------------------------------------------------>
                    </div>
                  </div>
                <input  class="btn btn-primary" type="submit" value="Modifier &rarr; ">
                </form>
              </div>
<!-- ------------------------------------------------------------------ -->
              <div class="reply-form">
                <h4>Trouver une Réunion</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form   method="post" action="<?php echo Router::url('searchers/reunions/'); ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="objet"><strong><i>Titre/Objet de la Réunion *</i></strong></option>
                              </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea  style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;" name="objet_1" class="form-control" placeholder="Entrez le Titre/Objet de la Réunion que vous cherchez*"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Trouver</button>

                </form>

              </div>

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Rechercher rapide avec un numéro</h3>
              <div class="sidebar-item search-form">
                <form   method="post" action="<?php echo Router::url('searchers/reunions/'.$id=1); ?>" enctype="multipart/form-data">
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