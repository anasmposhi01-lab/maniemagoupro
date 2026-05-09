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
        <h2 style="text-align: center;">BIENVENUE SUR LA PAGE QUI VOUS PERMET DE MODIFIER UN COURRIER SORTANT</h2>
        <u style="color: red;"><center>*******************************************************************</center></u>
        <ol>
          <li><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></li>
          <li style="text-align: justify;">Cette page vous permet une modification d'un Courrier sortant. Egalement, en bas de cette page, vous trouverez un formulaire qui permet de faire vos recherches, en cas de besoin. dans la partie annexe de cette page, un tableau statistique informant sur les courriers: entrants, courriers entrants orientés,les courriers sortants avec ses accusés réceptions, les Arrêtés, les réunions ainsi que les différents discours faits par le Gouvernement Provincial du Maniema.
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
                              <h5 style="text-align: justify;"><a href="#" class="reply"  > ♨_♨ Cette application offre son service qu'à la cellule informatique attachée au Bureau de Son Excellence Monsieur le Gouverneur de Province afin de faciliter, enrégistrement, consultation, modification et accès facile à tous les courriers reçus et ou signés par son Bureau. Le mécanisme d'accès y est alors stricte et des strictes mesures</a></h5>
                  </div>
                </div>
              </div>
              <!-- ---------$d['modifie_sortant--------------------------------------------------------- -->
<?php foreach ($modifie_sortant as $k => $v): ?>
              <center><h4>Veuillez apporter vos modifications dans le formulaire ci-dessous 👇</h4></center> 
              <div class="reply-form">
                <form  method="post" action="<?php echo Router::url('modif_suppressions/modif_sort/'); ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <h5><a href="#" class="reply"></i> 👇 Selectionez le Type de ce Courrier </a></h5>
                              <select name="type" type="text" class="anas1">
                                       <option value="<?php echo $v->type;?>"><strong><i>👉 valeur actuelle:<?php echo $v->type;?></i></strong></option>
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
                              <input hidden type="number" name="id" value="<?php echo $v->id;?>">         
                              <h3>✍ Veuiller entrer le Numéro de ce Courrier</h3>
                              <input class="form-control" type="text" name="num_c" value="<?php echo $v->num_c;?>">
                              <!------------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!----------------------------------------------------------------------------------------------------------------->
                          <h3>✍ Veuiller entrer l'Objet de ce Courrier *</h3>
                           <textarea  style="font-family:Helvetica,Arial,sans-serif; text-transform: uppercase;" name="objet" class="form-control" style="text" ><?php echo $v->objet;?></textarea>
                           <!-------------------------------------------------------------------------->

                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!----------------------------------------------------------------------------->
                             <h3>✍ Veuiller entrer le nom de la Personne Signataire de ce Courrier</h3>
                             <input class="form-control" type="text" name="nom_sign" value="<?php echo $v->nom_sign; ?>">
                           <!--------------------------------------------------------------------------->

                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!-------------------------------------------------------------------------->
                             
                             <h3>✍ Veuiller entrer la date de signature de ce Courrier</h3>
                             <input class="form-control" type="date" name="date_sign" value="<?php echo $v->date_sign; ?>">
                             <!--------------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------------------->
                             <h3>✍ Veuiller entrer le numéro de téléphone du destinateur de ce courrier: facultatif</h3>
                             <input class="form-control" type="number" name="num_phone" value="<?php echo $v->num_phone; ?>">
                             <!----------------------------------------------------------------------------------------------------------------->
                    </div>
                  </div>
                    <div class="row">
                      <div class="col form-group">
                             <h3>✍ Veuiller entrer le nom de celui à qui ce Courrier s'adresse</h3>
                             <input class="form-control" type="text" name="destinateur" value="<?php echo $v->destinateur; ?>">
                           <!----------------------------------------------------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------------->
                              <input hidden  class="form-control" type="text" name="date_enre" value="<?php echo date('d-m-Y');?>">
                              <!------------------------------------------------------------------------->
                              <!------------------------------------------------------------------------->
                              <input hidden  class="form-control" type="text" name="heure_enre" value="<?php echo date('H:i:s');?>">
                              <!------------------------------------------------------------------------->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                              <!------------------------------------------------------------------------------->
                              <input hidden class="form-control" type="text" name="file" value="<?php echo $v->file; ?>">
                    </div>
                  </div>
                <input  class="btn btn-primary" type="submit" value="Enrégistrer &rarr; ">
                </form>

              </div>
<?php endforeach; ?>
<!-- ------------------------------------------------------------------ -->
              <div class="reply-form">
                <h4>Rechercher</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form  method="post" action="<?php echo Router::url('searchers/sortant/'); ?>" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="num"><strong><i>Numéro *</i></strong></option>
                                       <option value="objet"><strong><i>Objet *</i></strong></option>
                                       <option value="exp"><strong><i>Nom du Bénéficiaire *</i></strong></option>
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

              <h3 class="sidebar-title">Rechercher rapide avec un numéro</h3>
              <div class="sidebar-item search-form">
                <form  method="post" action="<?php echo Router::url('searchers/sortant/'.$id=1); ?>" enctype="multipart/form-data" >
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