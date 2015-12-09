    <div class="background-slider slider">

            <div class="swiper-wrapper">
              <?php if(is_home() || "linee" == get_post_type()){

                  $slides = get_posts(array(
  'numberposts' => -1,
  'post_type' => 'background-slide'
));

if($slides){
  foreach($slides as $key => $slide){

              ?>

                <div class="swiper-slide" ><?php echo get_the_post_thumbnail($slide->ID);?>      <div class="big-claim">
        <p class="up" >
         <?php echo get_post_meta ( $slide->ID, 'claim_parte_superiore', true ); ?>
        </p>
        <p class="down" >
         <?php echo get_post_meta ( $slide->ID, 'claim_parte_inferiore', true ); ?>
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
