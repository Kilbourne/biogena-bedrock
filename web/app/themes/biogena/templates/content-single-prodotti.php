<?php
//delete_transient( 'biogena_data_prodotti');
while (have_posts()):
    the_post();

    $linea = biogenaData::data(get_post_type($post), get_the_title());
        $connected2 = $linea['prodotti'];
        if($linea['linea']['title']===__('Linea Osmin','sage')){
          $coadiuvanti= __("Trattamenti quotidiani complementari",'sage');
        }elseif ($linea['linea']['title']===__('Linea TAE-X & TAE','sage')) {
          $coadiuvanti= __("Fotoprotettori",'sage');
        }elseif ($linea['linea']['title']===__('Linea Laris','sage')) {
          $coadiuvanti= __("Trattamenti deodoranti complementari",'sage');
        }elseif ($linea['linea']['title']===__('Linea Tricologica','sage')) {
          $coadiuvanti= __("Trattamenti complementari tricologici",'sage');
        }elseif ($linea['linea']['title']===__('Biogena Slimgo & Euserpina Smagliature','sage')) {
          $coadiuvanti= __("Trattamenti complementari estetici",'sage');
        }else{
        $coadiuvanti= __("Trattamenti coadiuvanti complementari",'sage'); }?>
  <div class="nav-bread">
      <div class="go-back"><a href="<?php echo $linea['linea']['permalink'] ?>" title=""> &lt;&lt; <?php _e("Torna alla linea","sage");?> <?php echo $linea['linea']['title'] ?></a></div>
  </div>
  <article <?php $noproducts=count($connected2) > 0?'':'no-products';post_class($noproducts); ?>>
        <header class="palm">
        <h1 class="entry-title ">
          <?php the_title(); ?>
        </h1>
      </header>
    <div class="thumb-wrapper u-1/2-lap-and-up inline-block">
      <?php the_post_thumbnail('large'); ?>
      <div class="under-photo">          <?php $field = get_field_object('formato');
          if (isset($field['value']) && $field['value'] && $field['value'] !== '') { ?>
            <span class="formato"><?php echo $field['value']; ?></span>
          <?php } ?>
<span class="like">
        <iframe
        class="ce-iframe" data-ce-src="//www.facebook.com/plugins/like.php?href=http://www.biogenalab.it&amp;width=130&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false"
          scrolling="no"
          frameborder="0"
          style="border:none; overflow:hidden; width:108px; height:22px;"
          allowTransparency="true">
        </iframe>

      </span>
          </div>

    </div><div class="content-single-wrapper u-1/2-lap-and-up inline-block">
      <header class="desktop">
        <h1 class="entry-title ">
          <?php the_title(); ?>
        </h1>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>

      </div>
      <?php  $field = get_field_object('proprietà');
      if (isset($field['value']) && $field['value'] && $field['value'] !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#proprieta" aria-expanded="false" aria-controls="proprieta" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right  "> <h5><?php echo $field['label'];?></h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="proprieta ">
            <p><?php echo $field['value']; ?> </p>
          </div>
        </div>
      <?php } ?>
      <?php $field = get_field_object('composizione');
    if (isset($field['value']) && $field['value'] && $field['value'] !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#composizione" aria-expanded="false" aria-controls="composizione" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5><?php echo $field['label'];?></h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="composizione ">


          <p>
            <?php
        echo $field['value']; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
        <?php
    $field = get_field_object('uso');

    if (isset($field['value']) && $field['value'] && $field['value'] !== '') { ?>
        <div class="  accordion">
          <div class="dt"><a href="#uso" aria-expanded="false" aria-controls="uso" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5><?php echo $field['label'];?></h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="uso">


          <p>
            <?php
        echo $field['value']; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
        <?php
    $field = get_field_object('precauzioni');
    if (isset($field['value']) && $field['value'] && $field['value'] !== '') {
      $label = get_field('etichetta_precauzioni');
      $label = (isset($label) && $label && $label !== '') ? $label : $field['label'];?>
        <div class="accordion">
          <div class="dt"><a href="#precauzioni" aria-expanded="false" aria-controls="precauzioni" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5><?php echo $label;?></h5></a></div>
            <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="precauzioni">
            <p>
            <?php
        echo $field['value']; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
            <?php
    $field = get_field_object('consigli');
    if (isset($field['value']) && $field['value'] && $field['value'] !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#precauzioni" aria-expanded="false" aria-controls="precauzioni" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5><?php echo $field['label'];?></h5></a></div>
            <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="precauzioni">
            <p>
            <?php
        echo $field['value']; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
        <?php
    $field = get_field_object('evidenze_cliniche');
    if (isset($field['value']) && $field['value'] && $field['value'] !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#evidenze_cliniche" aria-expanded="false" aria-controls="evidenze_cliniche" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5><?php echo $field['label'];?></h5></a></div>
            <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="evidenze_cliniche">
            <p>
            <?php
        echo $field['value']; ?>
        <?php
    $field = get_field_object('bibliografia');
    if (isset($field['value']) && $field['value'] && $field['value'] !== '') { echo '<p class="rif-bib">'.$field['value'].'</p>';}?>
          </p>
          </div>
        </div>
        <?php
    } ?>
    <div class="product-last-line"><?php $field = get_field_object('faq');if(isset($field['value']) && $field['value'] && $field['value'] !=='') {echo '<span class="faq-single" ><a href="#product-faq" title="FAQ Prodotto" class="inline-popup-link"><span> '.$field['label'].' </span></a> </span>'; } ?><span class="ean"><?php $field = get_field_object('ean');if(isset($field['value']) && $field['value'] && $field['value'] !=='') {echo '<span>'.__("Non trovi il prodotto in farmacia? Questo è il codice a barre: EAN","sage").' - </span>' . $field['value'];}else{ $field = get_field_object('paraf');if(isset($field['value']) && $field['value'] && $field['value'] !=='') {echo '<span>'.__("Non trovi il prodotto in farmacia? Questo è il codice a barre: PARAF","sage").' - </span>' . $field['value'];} } ?></span></div>
    </div>
    <?php $field = get_field_object('faq');if(isset($field['value']) && $field['value'] && $field['value'] !=='') { ?>
    <div id="product-faq" class="white-popup mfp-hide">
 <?= $field['value']; ?>
</div>
<?php } ?>
    <?php

    if (count($connected2) > 0) { ?>
               <div class="slideshow correlati">
            <div class="slider-title">  <h3>  <?php _e($coadiuvanti,"sage");?> </h3></div>
              <?php if(count($connected2)>1){ ?>

                <div class=" slider-patologie active <?= count($connected2)===2?'two':'three' ?> <?= count($connected2)>3?'multi':'' ?> <?= count($connected2)>2?'multi2':'' ?>" >
              <?php }else {echo '<div class=" no-slider " >';} ?>
                    <div class="swiper-wrapper">
<?php


        foreach ($connected2 as $key2 => $prodotto) {
?>
                            <div class="swiper-slide"><a href="<?php echo $prodotto['permalink']; ?>"><?php echo $prodotto['thumbnail']; ?><div><h3><?php echo $prodotto['title']; ?> </h3> </div> </a></div>
                         <?php
        }
     ?>


                    </div>
                        <?php if(count($connected2)>1){ ?>
                                                                                    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
              <?php } ?>
                </div>
          </div>

   <?php } ?>
  </article>
<?php
endwhile; ?>
<script id="ce-iframePlaceholder-html" type="text/plain">

            <p class="cookie-text">Facebook Like | <?php _e('Per visualizzare questo contenuto è necessario accettare i cookie','sage'); ?></p><p class="cookie-link">
          <a href="#" class="ce-accept"><?php _e('Accetta i cookie','sage'); ?></a>
          <a href="<?php  echo get_page_link(640) ; ?>" title="" class="ajax-popup-link"><?php _e('Cookie policy','sage'); ?></a>
      </p>


</script>
