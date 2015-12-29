<?php
/**
 * Template Name: Area_riservata
 */
?>

<?php while (have_posts()) : the_post();the_content(); ?>


<?php if ( is_active_sidebar( 'sidebar-footer' ) && !is_user_logged_in()  ) : ?>
  <div id="sidebar-footer" class="primary-sidebar widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
    <div class="register"><a href="<?php $page_obj = get_page_by_title( 'Registrazione') ; echo get_page_link($page_obj -> ID) ; ?>" title="REGISTRATI" class="ajax-popup-link-r" >Registrati</a></div>
  </div><!-- #primary-sidebar -->
<?php endif; ?>
<?php endwhile; ?>
