    <div class="background-slider slider">
            <div class="swiper-wrapper">
              <?php if(is_home()){
                  $posts = get_posts(array(
  'numberposts' => -1,
  'post_type' => 'background-slide'
));

if($posts){
  foreach($posts as $key => $post){
              ?>
                <div class="swiper-slide" ><?php the_post_thumbnail( );?>      <div class="big-claim">
        <p class="up" >
         <?php the_field('claim_parte_superiore'); ?>
        </p>
        <p class="down" >
         <?php the_field('claim_parte_inferiore'); ?>
        </p>
      </div></div>

              <?php }} } ?>

            </div>
             <?php if(is_home()){
        if ( have_posts() ) :  the_post(); ?>
          <div class="news-box">
            <h3>News</h3>
            <div class="news">
              <h5><?php the_title();?></h5>
              <div class="content"><?php the_content('Leggi Tutto');?></div>
              <div class="archivio-link"><?php ?></div>
              <div class="more">
                <a href="" title="">Leggi Tutto</a>
                <a href="" title="">Archivio</a>
              </div>
            </div>
          </div>
      <?php
       endif;
        }
      ?>
    </div>
<div class="slideshow">
  <div class="container">
    <!--
    <div class="circle-container down">
      <div class="circle">
        <div class="custom-select">
          <select name="">
            <option value="patologie">SPECIALIZZATI IN...</option>
            <option value="prodotti">PRODOTTI</option>}
          </select>
        </div>
      </div>
    </div>
    -->
    <div class="slider slider-patologie active" >
      <div class="swiper-wrapper">
    <?php
      $args = array(
  'posts_per_page'   => -1,
  'post_type'        => 'aree-terapeutiche',
  );
  $posts_array = get_posts( $args );
   foreach ( $posts_array as $key=>$patologia ){ ?>
      <div  class="swiper-slide" ><a href="<?php echo get_permalink($patologia->ID); ?>" title=""><?php echo get_the_post_thumbnail($patologia->ID); ?> <div>

       <h3><?php echo get_the_title($patologia->ID); ?> </h3></div></a>

       </div>

      <?php } ?>
      </div>
      <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    </div>

</div>
</div>
