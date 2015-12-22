<?php while (have_posts()) : the_post();
echo do_shortcode('[video src="http://192.168.1.18/biogena/app/uploads/2015/12/Filmato-Breve-Amb-12.m4v"]' );
?>

  <?php get_template_part('templates/page', 'header');  ?>
  <?php $post_name=get_post_field( 'post_name', get_post() );
        if (locate_template( "templates/content-".$post_name.".php") ) { get_template_part('templates/content',$post_name);}
        else{get_template_part('templates/content', 'page');}
  ?>
<?php endwhile; ?>
