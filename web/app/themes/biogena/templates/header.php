<header class="banner">

  <div class="container">
    <!-- <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> -->
    <div class="background-slider slider">
            <div class="swiper-wrapper">
              <?php if(is_home()){
                  $posts = get_posts(array(
  'numberposts' => -1,
  'post_type' => 'background-slide'
));

if($posts){
  foreach($posts as $key => $post){
              ?>
                <div class="swiper-slide" ><?php the_post_thumbnail( );?>      <div class="big-claim">
        <p class="up" >
         <?php the_field('claim_parte_superiore'); ?>
        </p>
        <p class="down" >
         <?php the_field('claim_parte_inferiore'); ?>
        </p>
      </div></div>

              <?php }} } ?>

            </div>
    </div>
    <div class="header-content-wrapper">
      <nav class="nav-primary">
        <div class="fake-opacity"></div>
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif;
          ?>
          <!--
            <li class="menu-item"><a href="" title="">Azienda</a> </li><li class="menu-item" ><a href="" title="">Patologie</a></li><li class="menu-item menu-home" ><a href="" title=""><div class="circle-container"><div class="circle"> <div class="logo"></div><div class="claim"><p class="up">LA RICERCA ITALIANA</p><p class="down">PER IL BENESSERE DELLA CUTE</p></div></div></div></a> </li><li class="menu-item" ><a href="" title="">Prodotti</a> </li><li class="menu-item" ><a href="" title="">Contatti</a></li>
          -->
      </nav>

        <?php if(is_home()){
        if ( have_posts() ) :  the_post(); ?>
          <div class="news-box">
            <h3>News</h3>
            <div class="news">
              <h5><?php the_title();?></h5>
              <div class="content"><?php the_content('Leggi Tutto');?></div>
              <div class="archivio-link"><?php ?></div>
              <div class="more">
                <a href="" title="">Leggi Tutto</a>
                <a href="" title="">Archivio</a>
              </div>
            </div>
          </div>
      <?php
       endif;
        }
      ?>
    </div>
  </div>
</header>



