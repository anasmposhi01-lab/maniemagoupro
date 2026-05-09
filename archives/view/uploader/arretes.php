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
        <h2 style="text-align: center;">BIENVENUE SUR LA PAGE D'ENREGISTREMENT DES ARRÊTES DU GOUVERNEMENT PROVINCIAL DU MANIEMA</h2>
        <u style="color: red;"><center>*******************************************************************</center></u>
        <ol>
          <li><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></li>
          <li style="text-align: justify;">Cette page vous permet d'enrégistrer des Arrêtés du Gouvernement Provincial du Maniema.  Egalement, cette page permet de faire des recherches, en cas de besoin, dans notre serveur pour une utilisation utile. dans la partie annexe de cette page, vous êtes informé de toutes les statistiques liées au nombres de nos différents courriers, selon leur catégorie y compris les Arrêtés qui ont été signés par le Gouvernement Provincial du Maniema. Un bonus lié à l'accès aux listes reparties selon les différentes réunions tenues au Cabinet du Gouverneur s'y trouvent également.
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
                              <h5 style="text-align: justify;"><a href="#" class="reply"  > ♨_♨ Cette application offre son service qu'à la cellule informatique de Son Excellence Monsieur le Gouverneur du Maniema, afin de lui faciliter, consultation et accès facile à tous les courriers reçus et ou signés par son Bureau, le mécanisme d'accès y sont alors stricte et des strictes mesures</a></h5>
                  </div>
                </div>
              </div>
              <!-- ------------------------------------------------------------------ -->

              <div class="reply-form">
                <h4>Veuillez prendre soin de remplir ce formulaire</h4>
                <form  method="post"  action="<?php echo Router::url('uploader/arretes/'); ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <h5><a href="#" class="reply"></i> 👇 Selectionez le Type d'Arrêté' </a></h5>
                              <select name="type" type="text" class="anas1">
                                       <option value="gouvernement_provincial"><strong><i>Gouvernement Provincial</i></strong></option>
                                       <option value="pres"><strong><i>La Présidence</i></strong></option>
                                       <option value="prim"><strong><i>La Primature</i></strong></option>
                                       <option value="sg"><strong><i>Secrétariat Général de l'Urbanisme et Habitat</i></strong></option>
                                       <option value="min"><strong><i>Un Ministère</i></strong></option>
                                       <option value="div"><strong><i>Division de l'Urbanisme et habitat</i></strong></option>
                                       <option value="publ"><strong><i>Entreprise Publique</i></strong></option>
                                       <option value="priv"><strong><i>Entrerise Privée</i></strong></option>
                                       <option value="part"><strong><i>Particulier</i></strong></option>

                              </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <?php echo $this->Form->input('num_arret','', array('class'=>'form-control','type'=>'text','placeholder'=>'✍ Veuiller entrer le Numéro de cet Arrêté')); ?>
                            <!----------------------------------------------------------------------------------------------------------------->

                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                  <div class="row">
                    <div class="col form-group">
                              <!----------------------------------------------------------------------------------------------------------------->
                           <textarea  style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;" name="objet" class="form-control" placeholder=" ✍ Veuiller entrer l'Objet de cet Arrêté *"></textarea>
                           <!----------------------------------------------------------------------------------------------------------------->

                    </div>
                  </div>

                              <!----------------------------------------------------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <?php echo $this->Form->input('nom_sign','', array('class'=>'form-control','type'=>'text','placeholder'=>' ✍ Veuiller entrer le nom du Signateur de cet Arrêté')); ?>
                            <!----------------------------------------------------------------------------------------------------------------->

                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!----------------------------------------------------------------------------------------------------------------->
                              <h3>✍ Veuiller entrer la date de signature de cet Arrêté</h3>
                              <?php echo $this->Form->input('date_signat','', array('class'=>'form-control','type'=>'date','placeholder'=>' ✍ Veuiller entrer la date de signature de cet Arrêté')); ?>

                              <!----------------------------------------------------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!----------------------------------------------------------------------------------------------------------------->
                              <li> Cliquez 👇 ci-dessous pour Importer le fichier</li>
                              <?php echo $this->Form->input('file','',array('class'=>'form-control','type' =>'file')); ?>
                    </div>
                  </div>
                <input  class="btn btn-primary" type="submit" value="Enrégistrer &rarr; ">
                </form>

              </div>
<!-- ------------------------------------------------------------------ -->
              <div class="reply-form">
                <h4>Rechercher Un Arrêté</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form   method="post" action="<?php echo Router::url('searchers/arretes/'); ?>" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="num_arret"><strong><i>Numéro de l'Arrêté *</i></strong></option>
                                       <option value="objet"><strong><i>Objet de l'Arrêté *</i></strong></option>
                                       <option value="nom_sign"><strong><i>Nom du Signateur de l'Arrêté *</i></strong></option>
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

              <h3 class="sidebar-title">Rechercher rapide d'un Arrêté avec un numéro</h3>
              <div class="sidebar-item search-form">
                <form   method="post" action="<?php echo Router::url('searchers/arretes/'.$id=1); ?>" enctype="multipart/form-data" >
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