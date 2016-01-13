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
                <div class="boxx-wrapper"><h3>Parliamo di...</h3>
                                <div class="flag-body "><?= $first['content'];?><?php if(substr_count($first['content'], '</p>')>1){ // 2 ?><span class="readmore-box">Leggi Tutto</span><?php } ?> </div></div>
              </div><div class="box2 boxx">
                <div  class="boxx-wrapper"><h3>La soluzione Biogena</h3>

                                 <div class="flag-body">
                                   <p class="soluzione-text" >Garantiamo l consumatore prodotti e soluzioni che soddisfano i più elevati standard di qualità, sicurezza ed efficacia e di innovazione scientifica.</p>
                                   <p><?= $first['fields']['prevenzione'];?></p>
                                  <span class="readmore-box">Leggi Tutto</span>
                                 </div>
                                </div>

              </div><div class="box3 boxx">
                <div  class="boxx-wrapper">
                  <h3>FAQ</h3>
                  <div class="flag-body">
                    <p class="faq-text">Consulta le nostre FAQ per avere risposta alle tue domande più frequenti </p>
                    <span class="readmore-box">Leggi Tutto</span>
                  </div>
                </div>
              </div>
            </div>
             <div class="osmin content">
<div class="content-wrapper strecth">
            <hr >

               <?php $attivi=$first['fields']['attivi_di_linea'];$count=count($attivi); if($count>0){ ?>
               <div class="attivi-wrapper">
               <h3>Interamente esente da:</h3>
               <ul class="attivi">

                 <?php foreach ($attivi as $key => $attivo):
                 $image=$attivo['immagine_attivo'];
                 if($count>3){$count=3;}
                 ?>
                   <li class="attivo inline-block <?= 'w'.$count ?>"><img src="<?php echo $image['url']; ?>"  alt="<?php echo $image['alt']; ?>" /><?= $attivo['attivo']."<div class='attivo-desc'>".$attivo['descrizione_attivo']."</div>" ?></li>
                 <?php endforeach ?>
               </ul>
               </div>
               <?php } ?>
       <div class="content-wrapper strecth">

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
                  $page_obj = get_page_by_title( 'Area Riservata') ;
                  echo '<a href="'.get_page_link($page_obj -> ID).'" class="ajax-popup-link" >Accedi alla nostra area riservata.</a>';
                } else{?>
                  <a href="<?= $prod['permalink']; ?>"  title="">Vai alla scheda prodotto</a>
                <?php } ?>
                </div>
              </div>
            </div>
             <?php if(count($first['prodotti'])>3 && (  ($key+1) % 3 === 0 || $key===(count($first['prodotti'])-1))){ echo '</div>';} ?>
         <?php } ?>
         <?php if(count($first['prodotti'])>3){ echo '</div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div>';} ?>

                  </div>
              </div>
              </div>
 </div>
