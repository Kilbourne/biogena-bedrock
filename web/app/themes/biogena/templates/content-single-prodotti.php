<?php
//delete_transient( 'biogena_data_prodotti');
while (have_posts()):
    the_post();

    $linea = biogenaData::data(get_post_type($post), get_the_title());
  //  echo d($linea);
?>
  <div class="nav-bread">
      <div class="go-back"><a href="<?php echo $linea['linea']['permalink'] ?>" title=""> &lt;&lt; Torna alla linea <?php echo $linea['linea']['title'] ?></a></div>
  </div>
  <article <?php post_class(); ?>>
    <div class="thumb-wrapper u-1/2-lap-and-up inline-block">
      <?php the_post_thumbnail('large'); ?>
      <div class="under-photo">          <?php $field = get_field('formato');
          if (isset($field) && $field && $field !== '') { ?>
            <span class="formato"><?php echo $field; ?></span>
          <?php } ?>
<span class="like">
        <iframe
          src="//www.facebook.com/plugins/like.php?href=http://css-tricks.com&amp;width=130&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false"
          scrolling="no"
          frameborder="0"
          style="border:none; overflow:hidden; width:108px; height:22px;"
          allowTransparency="true">
        </iframe>
      </span>
          </div>

    </div><div class="content-single-wrapper u-1/2-lap-and-up inline-block">
      <header>
        <h1 class="entry-title">
          <?php the_title(); ?>
        </h1>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>

      </div>
      <?php  $field = get_field('proprietà');
      if (isset($field) && $field && $field !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#proprieta" aria-expanded="false" aria-controls="proprieta" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right  "> <h5>Proprietà</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="proprieta ">
            <p><?php echo $field; ?> </p>
          </div>
        </div>
      <?php } ?>
      <?php $field = get_field('composizione');
    if (isset($field) && $field && $field !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#composizione" aria-expanded="false" aria-controls="composizione" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5>Composizione</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="composizione ">


          <p>
            <?php
        echo $field; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
        <?php
    $field = get_field('uso');
    if (isset($field) && $field && $field !== '') { ?>
        <div class="  accordion">
          <div class="dt"><a href="#uso" aria-expanded="false" aria-controls="uso" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5>Uso</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="uso">


          <p>
            <?php
        echo $field; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
        <?php
    $field = get_field('precauzioni');
    if (isset($field) && $field && $field !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#precauzioni" aria-expanded="false" aria-controls="precauzioni" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5>Precauzioni</h5></a></div>
            <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="precauzioni">
            <p>
            <?php
        echo $field; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
        <?php
    $field = get_field('evidenze_cliniche');
    if (isset($field) && $field && $field !== '') { ?>
        <div class="accordion">
          <div class="dt"><a href="#evidenze_cliniche" aria-expanded="false" aria-controls="evidenze_cliniche" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"> <h5>Evidenze Cliniche</h5></a></div>
            <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="evidenze_cliniche">
            <p>
            <?php
        echo $field; ?>
          </p>
          </div>
        </div>
        <?php
    } ?>
    <div class="product-last-line"><?php $field = get_field('faq');if(isset($field) && $field && $field !=='') {echo '<span class="faq-single" ><a href="" title=""><span> FAQ Prodotto </span></a> </span>'; } ?><span class="ean"><?php $field = get_field('ean');if(isset($field) && $field && $field !=='') {echo '<span> EAN: </span>' . $field;}else{ $field = get_field('paraf');if(isset($field) && $field && $field !=='') {echo '<span> PARAF: </span>' . $field;} } ?></span></div>
    </div>
               <div class="slideshow correlati">
            <div class="slider-title">  <h3>  Trattamenti coadiuvanti complementari </h3></div>
                <div class=" slider-patologie active three" >
                    <div class="swiper-wrapper">
<?php
    $connected2 = $linea['prodotti'];
    if (count($connected2) > 0) {

        foreach ($connected2 as $key2 => $prodotto) {
?>
                            <div class="swiper-slide"><a href="<?php echo $prodotto['permalink']; ?>"><?php echo $prodotto['thumbnail']; ?><div><h3><?php echo $prodotto['title']; ?> </h3> </div> </a></div>
                         <?php
        }
    } ?>


                    </div>
                    <div class="navigation"></div>
                </div>
          </div>


  </article>
<?php
endwhile; ?>
