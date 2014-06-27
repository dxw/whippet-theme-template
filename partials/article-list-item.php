<article <?php post_class('article-list-item'); ?>>
  <header>
    <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php get_template_part('partials/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
