<?php
 $first=biogenaData::data('linee',get_the_title());
 $default_attr = array(
  'class' => "wp-post-image"
);
?>
<div class="osmin background-container">
<?= wp_get_attachment_image($first['fields']['immagine_full_width']['id'],'full',false,$default_attr).$first['fields']['claim_'] ; ?>

 </div>





            <div class="content-wrapper osmin">
              <div class="box1 boxx">
                <div class="boxx-wrapper left"><h3><?php _e("Parliamo di...","sage");?></h3>
                                <div class="flag-body "><div class="desc-foto"><img src="<?= $first['fields']['foto_descrizione'];?>" alt=""></div><?= $first['content'];?><?php if(substr_count($first['content'], '</p>')>1){ // 2 ?><span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span><?php } ?> </div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/doctor-1.jpg" alt="">
                                </div>
              </div><div class="box2 boxx">
                <div  class="boxx-wrapper left "><h3><?php _e("La soluzione Biogena","sage");?></h3>

                                 <div class="flag-body">
                                   <p class="soluzione-text" ><?php _e("Garantiamo l consumatore prodotti e soluzioni che soddisfano i più elevati standard di qualità, sicurezza ed efficacia.","sage");?></p>
                                   <p><?= $first['fields']['prevenzione'];?></p>
                                  <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span>
                                 </div>
                                 <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/lab-2.jpg" alt="">
                                </div>

              </div><div class="box3 boxx">
                <div  class="boxx-wrapper left">
                  <h3><?php _e("FAQ","sage"); ?></h3>
                  <div class="flag-body">
                    <p class="faq-text"><?php _e("Consulta le nostre FAQ per avere risposta alle tue domande più frequenti","sage"); ?> </p>
                    <span class="readmore-box"><?php _e("Leggi Tutto","sage");?></span>
                  </div>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/woman-ask.png" alt="">
                </div>
              </div>
            </div>
             <div class="osmin content">



               <?php $attivi=$first['fields']['attivi_di_linea'];$count=count($attivi); if($count>0){ ?>
               <hr>
               <div class="osmin-box">
               <h3><?php _e("La Linea Osmin è interamente esente da:","sage");?></h3>


                 <?php foreach ($attivi as $key => $attivo):
                      if($key===0 || $key%2 === 0){ echo '<div class="osmin-col">';}
                 ?>
<div class="accordion"><div class="dt"><a href="#precauzioni" aria-expanded="false" aria-controls="precauzioni" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"><?= $attivo['attivo'];?></a></div><div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="precauzioni"><p><?php echo $attivo['descrizione_attivo']; ?></p></div></div>
                 <?php   if($key===count($attivi)-1 || ($key-1)%2 === 0){ echo '</div>';}
                 endforeach ?>

               </div>
               <hr>
               <?php } ?>

       <div class="content-wrapper strecth">
<h4>  <?= substr($first['title'], 0,strlen('Linea'))==='Linea'?__("Scopri la","sage"):__("Scopri","sage");?> <?= $first['title']; ?></h4>
                <div class="products">
      <?php if(count($first['prodotti'])>3){ echo '<div class="swiper-wrapper">';} ?>
        <?php foreach($first['prodotti'] as $key=> $prod){ ?>
        <?php if(count($first['prodotti'])>3 && ($key===0 || ($key) % 3 === 0 )){ echo '<div class="swiper-slide">';} ?>
            <div class="product flag-media <?php echo $key % 2 == 0?'odd':'even'; ?>">

                <div>

                <h3 class='product-title'>
                     <?php if(!$riservato){ ?>
              <a href="<?= $prod['permalink']; ?>">
            <?php } ?>
                <?= $prod['title']; ?>
                <?php if(!$riservato){ ?>
              </a>
            <?php } ?>
                </h3> </div>

              <div class="flag-thumb">
              <?php if(!$riservato){ ?>
                <a href="<?= $prod['permalink']; ?>">
              <?php } ?>
                  <?= $prod['thumbnail']; ?>
              <?php if(!$riservato){ ?>
                </a>
              <?php } ?>
              </div><div class="flag-body">
                <?= $prod['content']; ?>
                <div class="more">
                <?php if($riservato){

                  echo '<a href="'.get_page_link(634).'" class="ajax-popup-link" ><?php _e("Accedi alla nostra area riservata.","sage");?></a>';
                } else{?>
                  <a href="<?= $prod['permalink']; ?>"  title=""><?php _e("Vai alla scheda prodotto","sage");?></a>
                <?php } ?>
                </div>
              </div>
            </div>
             <?php if(count($first['prodotti'])>3 && (  ($key+1) % 3 === 0 || $key===(count($first['prodotti'])-1))){ echo '</div>';} ?>
         <?php } ?>
         <?php if(count($first['prodotti'])>3){ echo '</div><div class="arrows-wrapper"><div class="swiper-button-prev"></div><p>'.__("Altri Prodotti","sage").'</p> <div class="swiper-button-next"></div></div><hr>';} ?>

                  </div>
              </div>

 </div>
