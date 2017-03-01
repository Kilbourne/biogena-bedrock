<?php
/*
Template Name: Archives
*/
 ?>




  <?php $post_type=get_post_type( $post );
        if (locate_template( "templates/content-archive-".$post_type.".php") ) { get_template_part('templates/content-archive',$post_type);}
        else{
$default_category = get_option('default_category');

 $args = array(
'posts_per_page'=>-1,
'cat'=>$default_category
);
 echo '<div style="position:relative;"><img src="'.get_stylesheet_directory_uri() .'/dist/images/archvio-news.jpg" alt=""><h1 class="archivio-news-title">'.__('Archivio News','sage').'</h1></div>';


$posts_array = get_posts( $args );
?>

<?php foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
<?php get_template_part('templates/content', 'single-post2'); ?>
<?php endforeach;
wp_reset_postdata();?>

<?php
} ?>
