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
        <h2 style="text-align: center;"> DECISION ET RECOMMANDATIONS  DE LA REUNION DU GOUVERNEMENT PROVINCIAL DU MANIEMA</h2>
        <u style="color: red;"><center>*******************************************************************</center></u>
        <ol>
          <li><a href="" style="color: red;"><?php echo $this->Session->flash(); ?></a></li>
          <li style="text-align: justify;">Cette page vous permet d'enrégistrer des listes de participants aux Réunions organisées au sein du Gouvernement Provincial du Maniema.  Egalement, cette page permet de faire des recherches, en cas de besoin, dans notre serveur pour une utilisation utile. dans la partie annexe de cette page, vous êtes informé de toutes les statistiques liées au nombres de nos différents courriers, selon leur catégorie y compris les Arrêtés qui ont été signés par le Gouvernement Provincial du Maniema. Un bonus lié à l'accès aux listes reparties selon les différentes réunions tenues au Cabinet du Gouverneur s'y trouvent également.
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
                              <h5 style="text-align: justify;"><a href="#" class="reply"  > ♨_♨ Cette application offre son service qu'à la cellule informatique de Son Excellence Monsieur le Gouverneur du Maniema, afin de faciliter, consultation et accès facile à tous les courriers reçus et ou signés par son Bureau, le mécanisme d'accès y sont alors stricte et des strictes mesures</a></h5>
                  </div>
                </div>
              </div>
              <!-- ------------------------------------------------------------------ -->
<?php foreach ($reunions as $k=>$v): ?>
              <div class="reply-form">
                <h4>Veuillez prendre soin de remplir ce formulaire</h4>
                <form  method="post" action="<?php echo Router::url('uploader/reunion_decisions_et_recommandations/'); ?>" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col form-group">
                                <!----------------------------------------------------------------------------------------------------------------->
                                <h3>✍ Liste des décisions prises</h3>
                                 <?php echo $this->Form->input('decisions','', array('type'=>'textarea',  'id'=>'editor','class'=>'xxlarge wysiwyg','rows'=>10, 'cols'=>200)); ?>
                               <!----------------------------------------------------------------------------------------------------------------->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col form-group">
                                <!----------------------------------------------------------------------------------------------------------------->
                                <h3>✍ Recommandations et actions à entreprendre</h3>
                                 <?php echo $this->Form->input('recommandations','', array('type'=>'textarea',  'id'=>'editor','class'=>'xxlarge wysiwyg','rows'=>10, 'cols'=>200)); ?>
                               <!---------------------------------------------------------------actions_entreprendre-------------------------------------------------->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col form-group">
                                <!----------------------------------------------------------------------------------------------------------------->
                                <h3>✍ Définissez les Actions à entreprendre formulées</h3>
                                 <?php echo $this->Form->input('actions_entreprendre','', array('type'=>'textarea',  'id'=>'editor','class'=>'xxlarge wysiwyg','rows'=>10, 'cols'=>200)); ?>
                               <!----------------------------------------------------------------------------------------------------------------->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col form-group">
                              <!---------------------------------------------------->
                              <input hidden type="text" name="cle_parent" value="<?php echo $v->cle_parent; ?>">
                              <input hidden type="number" name="id" value="<?php echo $v->id; ?>">
                              <input hidden type="text" name="objet_reunion" value="<?php echo $v->objet; ?>">
                             <!----------------------------------------------------------------------------------------------------------------->
                        
                      </div>
                    </div>

                <input  class="btn btn-primary" type="submit" value="Enrégistrer &rarr; ">
                </form>
              </div>
<?php endforeach;?>
<!-- ------------------------------------------------------------------ -->
              <div class="reply-form">
                <h4>Chercher une Réunion</h4>
                <p>Veuillez 👇 selectioner le mode de recherche * </p>
                <form   method="post" action="<?php echo Router::url('searchers/reunions/'); ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 form-group">
                              <select name="mode" type="text"  class="anas1">
                                       <option value="objet"><strong><i>Objet de la Réunion *</i></strong></option>
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

              <h3 class="sidebar-title">Rechercher rapide d'une des Réunions</h3>
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
<script type="text/javascript" src="<?php echo Router::webroot('js\tinymce\tinymce.js'); ?>">
</script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@2/dist/tinymce-webcomponent.min.js"></script>

<script>
  tinymce.init({
    selector: '#editor',
    editer_selector : 'wysiwyg',
    relative_urls : false,
    mode: 'specific_textareas',
    plugins: 'a11ychecker advcode advtemplate advlist advtable anchor autocorrect autosave editimage image link linkchecker lists markdown media mediaembed pageembed powerpaste searchreplace table template tinymcespellchecker typography visualblocks wordcount inlinepopups style',
    toolbar: 'undo redo | styles fontsizeinput | bold italic | align bullist numlist | table link image media pageembed | spellcheckdialog a11ycheck code | inserttemplate | strikethrough',
    toolbar_sticky: true,
    toolbar_mode: 'wrap',
    height: 620,
    editable_root: false,
    editable_class: 'tiny-editable',
    //file_browser_callback : 'filebrowser',
    elementpath: false,
    object_resizing: false,
    resize: false,
    image_caption: true,
    images_file_types: "jpeg,jpg,png,gif",
    automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
   file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: (cb, value, meta) => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.addEventListener('change', (e) => {
      const file = e.target.files[0];

      const reader = new FileReader();
      reader.addEventListener('load', () => {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        const id = 'blobid' + (new Date()).getTime();
        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        const base64 = reader.result.split(',')[1];
        const blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      });
      reader.readAsDataURL(file);
    });

    input.click();
    },
    style_formats: [
      {title: 'Heading 1', block: 'h1'},
      {title: 'Heading 2', block: 'h2'},
      {title: 'Heading 3', block: 'h3'},
      {title: 'Paragraph', block: 'p'},
      {title: 'Blockquote', block: 'blockquote'},
      {title: 'Fancy list', selector: 'ul', classes: 'fancy'},
      ],
    advcode_inline: true,
    spellchecker_ignore_list: [ 'CMS', 'devs' ],
    a11ychecker_level: 'aaa',
    advtemplate_templates: [
      {
        title: "About us",
        content:
          '<h2>About our company</h2>\n<p><a href="<a href="https://tiny.cloud">https://tiny.cloud</a>">XYZ Inc.</a> is a global leader in providing innovative solutions to businesses. We provide our clients with the latest technology, state-of-the-art equipment, and experienced professionals to help them stay ahead of their competition. Our comprehensive suite of services, from cloud computing and big data analytics to mobile and e-commerce solutions, ensures that all of our clients have the resources they need to stay competitive in an ever-changing business landscape. Our commitment to customer service and satisfaction is second to none, and we strive to be a reliable and trusted partner for our clients.</p>',
      },
    ],
  });
 /*function file_browser(field, url, win){
       tinyMCE.activeEditor.windowManager.open({file : 'http://google.com',
        <?php // echo Rooter::url('admin/index'.$id);?>
        title : Galerie,
        width: 420,
        height:400,
        resizable : 'yes',
        inline : 'yes', 
        close_previous : 'no'
      },{
        window :win,
        input : field_name
       }); 
       return false;
      }*/ 
</script>