<?php while (have_posts()) : the_post();
$linea=biogenaData::data(get_the_permalink( ),get_post_type( $post ));
?>
  <article <?php post_class(); ?>>
    <div class="thumb-wrapper u-1/2-lap-and-up inline-block">
      <?php the_post_thumbnail('large'); ?>
      <div class="like">

<iframe
  src="//www.facebook.com/plugins/like.php?href=http://css-tricks.com&amp;width=130&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false"
  scrolling="no"
  frameborder="0"
  style="border:none; overflow:hidden; width:108px; height:22px;"
  allowTransparency="true"></iframe>
</div>
    </div><div class="content-single-wrapper u-1/2-lap-and-up inline-block">
        <header>
          <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <?php $field=get_field('formato'); if($field !==''){ ?>
        <div class=" accordion">
          <div class="dt"><a href="#formato" aria-expanded="false" aria-controls="formato" class="accordion-title accordionTitle js-accordionTrigger"> <h5>Formato</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="formato">


          <p>
            <?php echo $field;  ?>
          </p>
          </div>
        </div>
        <?php }  ?>
        <?php $field=get_field('proprietà'); if($field !==''){ ?>
        <div class="accordion">
          <div class="dt"><a href="#proprieta" aria-expanded="false" aria-controls="proprieta" class="accordion-title accordionTitle js-accordionTrigger"> <h5>Proprietà</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="proprieta ">


          <p>
            <?php echo $field;  ?>
          </p>
          </div>
        </div>
        <?php }  ?>
        <?php $field=get_field('uso'); if($field !==''){ ?>
        <div class="  accordion">
          <div class="dt"><a href="#uso" aria-expanded="false" aria-controls="uso" class="accordion-title accordionTitle js-accordionTrigger"> <h5>Uso</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="uso">


          <p>
            <?php echo $field;  ?>
          </p>
          </div>
        </div>
        <?php }  ?>
        <?php $field=get_field('precauzioni'); if($field !==''){ ?>
        <div class="accordion">
          <div class="dt"><a href="#precauzioni" aria-expanded="false" aria-controls="precauzioni" class="accordion-title accordionTitle js-accordionTrigger"> <h5>Precauzioni</h5></a></div>
            <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="precauzioni">
            <p>
            <?php echo $field;  ?>
          </p>
          </div>
        </div>
        <?php }  ?>
    </div>
               <div class="slideshow correlati">
            <h3>  Trattamenti coadiuvanti complementari </h3>
                <div class=" slider-patologie active three" >
                    <div class="swiper-wrapper">
<?php   $connected2=$linea->first->conn_arr;
              if ( count($connected2)>0 ){

          foreach ( $connected2 as $key2=>$prodotto ){
          if($prodotto->permalink!==get_permalink($post)){ ?>
                            <div class="swiper-slide"><a href="<?php echo $prodotto->permalink; ?>"><?php echo $prodotto->thumb; ?><div><h3><?php echo $prodotto->title; ?> </h3> </div> </a></div>
                         <?php
          }

          }
    } ?>


                    </div>
                </div>
          </div>


  </article>
<?php endwhile; ?>
