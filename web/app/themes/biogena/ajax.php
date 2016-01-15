<?php
/**
 * Template Name: Ajax
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page');
  	if(get_the_title()==='Registrazione'){
  		$backlink='<a style="text-decoration:none;color:#24569B;font-weight:700;" href="';

  		$backlink.=get_page_link(634) ;
  		$backlink.='" class="ajax-popup-link-r">'.__("Ritorna al login.","sage").'</a>';
  		echo  $backlink;
  	}
  ?>
<?php endwhile; ?>
