<header class="banner">




    <div class="header-content-wrapper">
      <nav class="nav-primary">
        <div class="fake-opacity"></div>
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
          ?>
            <div class="responsive-menu-wrapper" >
              <?php echo do_shortcode( ' [responsive-menu menu="Mobile Menu"]' );  ?>
            </div>

          <?php
            endif;
          ?>
          <!--
            <li class="menu-item"><a href="" title="">Azienda</a> </li><li class="menu-item" ><a href="" title="">Patologie</a></li><li class="menu-item menu-home" ><a href="" title=""><div class="circle-container"><div class="circle"> <div class="logo"></div><div class="claim"><p class="up">LA RICERCA ITALIANA</p><p class="down">PER IL BENESSERE DELLA CUTE</p></div></div></div></a> </li><li class="menu-item" ><a href="" title="">Prodotti</a> </li><li class="menu-item" ><a href="" title="">Contatti</a></li>
          -->
      </nav>

</header>



