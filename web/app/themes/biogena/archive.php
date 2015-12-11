



  <?php /* get_template_part('templates/page', 'header'); */ ?>
  <?php $post_type=get_post_type( $post );
        if (locate_template( "templates/content-archive-".$post_type.".php") ) { get_template_part('templates/content-archive',$post_type);}
        else{

get_template_part('templates/page', 'header');
 if (have_posts()) : the_post();
while (have_posts()) : the_post(); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php if($wp_query->current_post === 0) { get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); }?>
<?php endwhile; ?>

<?php the_posts_navigation();

  ?>
<?php endwhile; endif;} ?>
