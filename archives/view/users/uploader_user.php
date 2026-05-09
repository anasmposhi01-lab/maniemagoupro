<!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <h2 style="text-align: center;">BIENVENUE SUR LA PAGE D'ENREGISTREMENT D'UN UTILISATEUR DE CETTE APPLICATION</h2>
        <u style="color: red;"><center>*******************************************************************</center></u>
        <ol>
          <li style="text-align: justify;">Cette page vous permet d'enrégistrer les Utilisateurs de cette Application. Vous êtes prié de remplir l'identité de l'utilisateur et télécharger une photo de son prile.
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
                <div class="d-flex">
                  <div class="comment-img"><a href=""><img src="<?php  echo Router::url('webroot/logo_1.jpg');?>" alt=""></a></div>
                  <div  class="comment-img">
                              <h5 style="text-align: justify;"><a href="#" class="reply"  > ♨_♨ Cette application offre son service qu'à la cellule informatique attachée au Bureau de Son Excellence Monsieur le Gouverneur Province afin de faciliter, enrégistrement, consultation, modification et accès facile à tous les courriers reçus et ou signés par son Bureau. Le mécanisme d'accès y est alors stricte et des strictes mesures</a></h5>
                  </div>
                </div>
              </div>
              <!-- ------------------------------------------------------------------ -->
              <center><h4>Veuillez remplire le formulaire ci-dessous avec les identités de cet Utilisateur 👇</h4><li><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></li></center> 
              <div class="reply-form">
                <form  method="post" action="<?php echo Router::url('users/uploader_user/'); ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col form-group">
                              <!----------------------------------------------------->
                              <h3><a href="#" class="reply"></i> 👇 Selectionez le Sexe de l'Utilisateur * </a></h3>
                              <select name="sexe" type="text" class="anas1">
                                       <option value="homme"><strong><i>Homme *</i></strong></option>
                                       <option value="femme"><strong><i>Femme *</i></strong></option>
                              </select>
                           <!--------------------------------------------------->

                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!--------------------------------------------------->
                              <h3>✍ Veuiller entrer la Fonction de cet Utilisateur *</h3>
                              <input  class="form-control" type="text" name="role"  placeholder="✍ Veuiller entrer la Fonction de cet Utilisateur ici  *">
                           <!----------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <h3>✍ Veuiller entrer le nom de l'Utilisateur *</h3>
                              <input  class="form-control" type="text" name="nom"  placeholder="✍ Veuiller entrer le nom de l'Utilisateur ici  *">
                              <!---------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!--------------- -------------------------------------->
                              <h3>✍   Veuiller entrer le Post-nom de l'Utilisateur *"</h3>
                              <input  class="form-control" type="text" name="pst_noms"  placeholder="✍ Veuiller entrer le Prénom de l'Utilisateur ici  *">
                           <!--------------------------------------------------->

                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!----------------------------------------------------->
                              <h3>✍ Veuiller entrer le Prénom de l'Utilisateur *</h3>
                              <input  class="form-control" type="text" name="pr_noms"  placeholder="✍ Veuiller entrer le Prénom de l'Utilisateur ici  *">
                           <!--------------------------------------------------->

                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------------->
                              <h3>✍ Veuiller entrer le Mot de Passe de l'Utilisateur *</h3>
                              <input  class="form-control" type="text" name="pass_propre" placeholder="✍ Veuiller entrer le Mot de Passe de l'Utilisateur  ici *">
                              <!------------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------------->
                              <h3>✍ Veuiller repéter votre Mot de Passe de l'Utilisateur *</h3>
                              <input  class="form-control" type="text" name="pass_propre1" placeholder=" ✍ Veuiller repéter votre Mot de Passe de l'Utilisateur ici *">
                              <!------------------------------------------------------------------------->
                    </div>
                  </div>
                              <!------------------------------------------------------------------------->
                              <input hidden  class="form-control" type="text" name="date_enre" value="<?php echo date('d-m-Y');?>">
                              <!------------------------------------------------------------------------->
                              <!------------------------------------------------------------------------->
                              <input hidden  class="form-control" type="text" name="heure_enre" value="<?php echo date('H:i:s');?>">
                              <!------------------------------------------------------------------------->
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------>
                              <h3>✍ Veuiller télécharger la Photo de cet Utilisateur *</h3>
                              <input class="form-control" type="file" name="file">
                    </div>
                  </div>
                <input  class="btn btn-primary" type="submit" value="Enrégistrer &rarr; ">
                </form>

              </div>
<!-- ------------------------------------------------------------------ -->
              <div class="reply-form">
                <h4>Rechercher un User</h4>
                <p>Veuillez 👇 selectioner la méthode de recherche * </p>
                <form  method="post" action="<?php echo Router::url('searchers/user/'); ?>" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="nom"><strong><i>Nom *</i></strong></option>
                                       <option value="post_noms"><strong><i>Post_nom *</i></strong></option>
                                       <option value="pr_noms"><strong><i>Prénom *</i></strong></option>
                                       <option value="role"><strong><i>Fonction *</i></strong></option>
                              </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="objet_1" class="form-control" placeholder="Entrez votre  Référence *"></textarea>
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
                <form  method="post" action="<?php echo Router::url('searchers/user/'.$id=1); ?>" enctype="multipart/form-data" >
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