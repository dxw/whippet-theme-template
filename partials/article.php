<article <?php post_class('article'); ?>>
  <header>
    <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php get_template_part('partials/entry-meta'); ?>
  </header>
  <div class="entry">
    <?php the_content(); ?>
  </div>
</article>
