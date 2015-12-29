<?php
/**
 * Template Name: Ajax
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); 
  	if(get_the_title()==='Registrazione'){
  		$backlink='<a href="';$page_obj = get_page_by_title( 'Area Riservata') ; 
  		
  		$backlink.=get_page_link($page_obj -> ID) ;
  		$backlink.='" class="ajax-popup-link-r">Ritorna al login.</a>';
  		echo  $backlink;
  	}
  ?>
<?php endwhile; ?>
