<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <div class="news-wrap"><?php the_post_thumbnail() ?></div><div class="news-content">
        <?php the_content(); ?>
      </div>
    </div>



  </article>
<?php endwhile; ?>
