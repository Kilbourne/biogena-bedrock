<?php
/*
Template Name: Archives
*/
 ?>




  <?php $post_type=get_post_type( $post );
        if (locate_template( "templates/content-archive-".$post_type.".php") ) { get_template_part('templates/content-archive',$post_type);}
        else{

get_template_part('templates/page', 'header');
 $args = array(
  'type'            => 'postbypost',
  'order'           => 'DESC'
);
wp_get_archives( $args );


} ?>
