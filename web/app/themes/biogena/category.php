<?php  echo '<div style="position:relative;"><img src="'.get_stylesheet_directory_uri() .'/dist/images/archvio-news.jpg" alt=""><h1 class="archivio-news-title">'. single_cat_title( '', false ) .'</h1></div>';
 ?>


<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/content', 'single-post2'); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
