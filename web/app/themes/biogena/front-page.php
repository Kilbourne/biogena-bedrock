    <div class="background-slider slider">

      <div class="swiper-wrapper">

<?php
    $slides = get_posts(array('numberposts' => - 1, 'post_type' => 'background-slide'));

    if ($slides) {
        foreach ($slides as $key => $slide) {
          $image_id=get_post_thumbnail_id($slide->ID);
$image_meta = wp_get_attachment_metadata( $image_id );
$image = wp_get_attachment_image_src( $image_id,'full');
if ( $image ) {
    $image_src = $image[0];
    $size_array = array(
        absint( $image[1] ),
        absint( $image[2] )
    );
}
$srcset_value = wp_calculate_image_srcset( $size_array, $image_src, $image_meta );
$sizes_value = wp_get_attachment_image_sizes($image_id, 'full' );
$srcset = $srcset_value ? ' srcset="' . esc_attr( $srcset_value ) . '"' : '';
$sizes = $sizes_value ? ' sizes="' . esc_attr( $sizes_value ) . '"' : '';
?>

        <div class="swiper-slide <?php
            echo $slide->post_title; ?>" >
            <img <?php  echo $srcset.' '.$sizes;  ?> class="swiper-lazy wp-post-image" src="<?= $image_src ?>"  alt="">
      <div class="big-claim">
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
      <h3><?php _e("News","sage"); ?></h3>
      <div class="news">
        <h5><?php
        the_title(); ?></h5>
        <div class="content"><?php
        the_content(__('Leggi Tutto','sage')); ?><a href="
<?php  echo get_page_link(1181) ; ?>

" title="" ><?php _e("Altre News","sage"); ?></a></div>
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
      <div  class="swiper-slide" ><a href="<?php echo get_permalink($patologia->ID); ?>" title="">
      <?php
        $thumb=get_post_thumbnail_id($patologia->ID);
        $img_src_f=wp_get_attachment_image_src($thumb,'full' )[0];

        $img_src_m=wp_get_attachment_image_src( $thumb,'medium')[0];
        $img_src_s=wp_get_attachment_image_src( $thumb,'thumbnail')[0];

      ?>
        <img srcset="<?= $img_src_f  ?> 800w,  <?= $img_src_m ?> 300w, <?= $img_src_s ?> 150w" sizes="(min-width:1215px ) 22.0665vw, (min-width:912px ) 29.422vw, (min-width:608px ) 44.133vw, 94vw"  alt="">
      <?php //echo get_the_post_thumbnail($patologia->ID,'medium'); ?>
         <div>

       <h3><?php echo get_the_title($patologia->ID); ?> </h3></div></a>

       </div>

      <?php } ?>
      </div>
      <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
    </div>

</div>
</div>
