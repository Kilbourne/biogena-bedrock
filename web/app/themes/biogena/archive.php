<?php
/*
Template Name: Archives
*/
 ?>




  <?php $post_type=get_post_type( $post );
        if (locate_template( "templates/content-archive-".$post_type.".php") ) { get_template_part('templates/content-archive',$post_type);}
        else{


 $args = array(
  'type'            => 'postbypost',
  'order'           => 'DESC'
);
 echo '<div style="position:relative;"><img src="'.get_stylesheet_directory_uri() .'/dist/images/archvio-news.jpg" alt=""><h1 class="archivio-news-title">'.__('Archivio News','sage').'</h1></div>';

wp_get_archives( $args );


} ?>
