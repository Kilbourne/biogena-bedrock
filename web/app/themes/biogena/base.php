<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;


if(get_post_type()==='post'&& is_single()){
	if($_GET["ajax"] === "true"){?>

  <div class="content row">
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
      <script>

window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-73351910-1', 'auto');
ga('set', 'anonymizeIp', true);
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<?php }else{ ?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <div class="page-wrapper wrapper wrapper--wide" role="document">
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

      <div class="content row">
        <main class="main">

          <?php echo '<div style="position:relative;"><img src="'.get_stylesheet_directory_uri() .'/dist/images/archvio-news.jpg" alt=""></div><div class="article-wrap" ><div class="article-wrap2" >';include Wrapper\template_path();echo "</div>";$args = array(
  'type'            => 'postbypost',
  'order'           => 'DESC'
);

echo '<div class="news-archive-wrap"> <h3 class="archivio-titolo">'.__('Archivio News','sage').'</h3>';
wp_get_archives( $args ); ?>
        </div></div></main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');

    ?>
    </div><!-- /.wrap -->
          <script>

window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-73351910-1', 'auto');
ga('set', 'anonymizeIp', true);
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
    <?php get_template_part('templates/underscore-template');
 wp_footer();
    ?>
  </body>
</html>


<?php
}}else{
?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <div class="page-wrapper wrapper wrapper--wide" role="document">
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

      <div class="content row">
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');

    ?>
    </div><!-- /.wrap -->
          <script>

window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-73351910-1', 'auto');
ga('set', 'anonymizeIp', true);
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
    <?php get_template_part('templates/underscore-template');
 wp_footer();
    ?>
  </body>
</html>
<?php } ?>
