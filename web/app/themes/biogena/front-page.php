    <div class="background-slider slider">

      <div class="swiper-wrapper">

<?php
    $slides = get_posts(array('numberposts' => - 1, 'post_type' => 'background-slide'));

    if ($slides) {
        foreach ($slides as $key => $slide) {
?>

        <div class="swiper-slide <?php
            echo $slide->post_title; ?>" ><?php
            echo get_the_post_thumbnail($slide->ID); ?>      <div class="big-claim">
          <p class="up" >
           <?php
            echo get_post_meta($slide->ID, 'claim_parte_superiore', true); ?>
         </p><p class="down" >
           <?php
            echo get_post_meta($slide->ID, 'claim_parte_inferiore', true); ?>
         </p>
       </div></div>

       <?php
        }
    } ?>

     </div>
   <?php
    $posts = get_posts(array('numberposts' => - 1));
    if ($posts):
        setup_postdata($posts[0]) ?>
     <div class="news-box">
      <h3>News</h3>
      <div class="news">
        <h5><?php
        the_title(); ?></h5>
        <div class="content"><?php
        the_content('Leggi Tutto'); ?><a href="
<?php $page_obj = get_page_by_title( 'Articoli') ; echo get_page_link($page_obj -> ID) ; ?>

" title="" >Altre News</a></div>
      </div>
    </div>
    <?php
    endif;
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
    <div class="slider slider-patologie slider-patologie-home active four" >
      <div class="swiper-wrapper">
    <?php
      $args = array(
  'posts_per_page'   => -1,
  'post_type'        => 'area-skin-care',
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
