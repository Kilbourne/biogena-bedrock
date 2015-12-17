<?php if(is_home()){ ?>
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
        the_content('Leggi Tutto'); ?><a href="<?php
        the_permalink(); ?>" title="">Altre News</a></div>
      </div>
    </div>
    <?php
    endif;
?>
</div>
<?php }else if("aree-terapeutiche" == get_post_type()){ ?>
 <div class="background-container">
<?php
if ( is_post_type_archive() ) {
$aaa=biogenaData::data(0)->first;echo '<img  class="attachment-post-thumbnail wp-post-image" src="'.$aaa->feat.'" alt=""><div class="big-claim">'.$aaa->claim.'</div>';
}else if(is_single()){
 echo '<img  class="attachment-post-thumbnail wp-post-image" src="'.get_field('immagine_full_width')['url'].'" alt=""><div class="big-claim">'.get_field('claim_').'</div>';

}
?>
</div>

<?php }else if("linee" == get_post_type()){ ?>
<div class="background-container">
<?php


if ( is_post_type_archive() ) {
  $aaa=biogenaData::data(0,'linee')->first;//echo var_dump($aaa);
echo $aaa->thumb.'<div class="big-claim">'.$aaa->claim.'</div>';
}else if(is_single()){
$aaa=biogenaData::data(get_the_permalink(),'linee')->first;//echo var_dump($aaa);
 echo the_post_thumbnail( ).'<div class="big-claim">'.$aaa->claim.'</div>';

}
?>
</div>

<?php } ?>
