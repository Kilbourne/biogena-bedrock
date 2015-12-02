<?php while (have_posts()) : the_post(); ?>
<?php $linea=biogenaData::data($post,get_post_type( $post ));
      $linea_name=$linea->post_name;
        $connected2 = get_posts( array(
                'connected_type' => 'linee_to_prodotti',
                'connected_items' => $linea,
                'nopaging' => true
              ));
?>
  <article <?php post_class(); ?>>
    <div class="thumb-wrapper u-1/2-lap-and-up inline-block">
      <?php the_post_thumbnail('large'); ?>
      <div class="like"><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/mi-piace-fb.jpg'; ?>" alt=""> </div>
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
            <?php echo $field;}  ?>
          </p>
          </div>
        </div>
        <?php $field=get_field('proprietà'); if($field !==''){ ?>
        <div class="accordion">
          <div class="dt"><a href="#proprieta" aria-expanded="false" aria-controls="proprieta" class="accordion-title accordionTitle js-accordionTrigger"> <h5>Proprietà</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="proprieta ">


          <p>
            <?php echo $field;}  ?>
          </p>
          </div>
        </div>
        <?php $field=get_field('uso'); if($field !==''){ ?>
        <div class="  accordion">
          <div class="dt"><a href="#uso" aria-expanded="false" aria-controls="uso" class="accordion-title accordionTitle js-accordionTrigger"> <h5>Uso</h5></a></div>
          <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="uso">


          <p>
            <?php echo $field;}  ?>
          </p>
          </div>
        </div>
        <?php $field=get_field('precauzioni'); if($field !==''){ ?>
        <div class="accordion">
          <div class="dt"><a href="#precauzioni" aria-expanded="false" aria-controls="precauzioni" class="accordion-title accordionTitle js-accordionTrigger"> <h5>Precauzioni</h5></a></div>
            <div class="accordion-content accordionItem is-collapsed"  aria-hidden="true" id="precauzioni">
            <p>
            <?php echo $field;}  ?>
          </p>
          </div>
        </div>
    </div>
               <div class="slideshow correlati">
            <h3>  Trattamenti coadiuvanti complementari </h3>
                <div class=" slider-patologie active" >
                    <div class="swiper-wrapper">
<?php                 if ( count($connected2)>0 ){

          foreach ( $connected2 as $key2=>$prodotto ){
          if($prodotto->ID!==$post->ID){ ?>
                            <div class="swiper-slide"><a href="<?php echo get_permalink($prodotto->ID); ?>"><?php echo get_the_post_thumbnail($prodotto->ID); ?><div><h3><?php echo $prodotto->post_title; ?> </h3> </div> </a></div>
                         <?php
          }

          }
    } ?>


                    </div>
                </div>
          </div>


  </article>
<?php endwhile; ?>
