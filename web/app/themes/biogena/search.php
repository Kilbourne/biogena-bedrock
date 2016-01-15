<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Nessun risultato trovato.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'search'); ?>
<?php endwhile; ?>

<?php the_posts_navigation(  array(
  'prev_text'           => __('Risultati precedenti','sage'),
  'next_text'          => __('Risultati successivi','sage'),
  'screen_reader_text' =>' '
)); ?>
