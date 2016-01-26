<div class="faq-main">


<?php
      $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'post_type'        => 'area-skin-care',
      );
      $posts_array = get_posts( $args );
            foreach ( $posts_array as $key_s =>$subject ){
              $field = get_field('faq', $subject->ID, $format_value);
              echo '<p class="faq-title">'.$subject->post_title.'</p><div class="faq-content">'.$field.'</div> ';

            }
?>
</div>
