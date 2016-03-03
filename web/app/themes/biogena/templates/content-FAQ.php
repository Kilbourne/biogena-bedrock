<div class="faq-main">

<h3><?= __('Domande ricorrenti relative alle aree skin care.','sage'); ?> </h3>
<p class="sub-little"><?= __('A cura di','sage').' AIDECO (Associazione Italiana di Dermatologia e Cosmetologia)'; ?>  </p>

<?php
      $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'post_type'        => __('area-skin-care','sage'),
      );
      $posts_array = get_posts( $args );
      $posts_count = count($posts_array);

            foreach ( $posts_array as $key_s =>$subject ){
              if($key_s===0 || $key_s=== intval((round($posts_count/2)))){echo '<div class="faq-col">';}
              $field = get_field('faq', $subject->ID, $format_value);
              echo '<p class="faq-title"><span><img src=" '. get_stylesheet_directory_uri() .'/dist/images/loghetto.png" ></span>'.$subject->post_title.'</p><div class="faq-content"><h3>'.$subject->post_title.'</h3><div class="faq-wrapper">'.$field.'</div></div> ';
              if($key_s===$posts_count-1 || $key_s=== intval((round($posts_count/2)-1))){echo '</div>';}
            }
?>
</div>
