<?php
/**
 * Template Name: Ajax
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
   <?php $post_name=strtolower (get_post_field( 'post_name', get_post() ));

        if (locate_template( "templates/content-".$post_name.".php") ) { get_template_part('templates/content',$post_name);}
        else{get_template_part('templates/content', 'page');}
  ?>
  <?php
  	if(get_the_title()==='Registrazione'){
  		$backlink='<a style="text-decoration:none;color:#24569B;font-weight:700;" href="';

  		$backlink.=get_page_link(634) ;
  		$backlink.='" class="ajax-popup-link-r">'.__("Ritorna al login.","sage").'</a>';
  		echo  $backlink;
  	}
  ?>
<?php endwhile; ?>
