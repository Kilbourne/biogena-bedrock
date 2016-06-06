<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;


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
      <script>
      
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-75826071-1', 'auto');
ga('set', 'anonymizeIp', true);
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
