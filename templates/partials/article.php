<article <?php post_class('article'); ?>>
  <header>
    <h1><?php the_title(); ?></h1>
    <?php get_template_part('partials/entry-meta'); ?>
  </header>

  <div class="entry content rich-text">
      <?php if(has_post_thumbnail()) :
        the_post_thumbnail('large');
      endif; ?>
      <?php the_content(); ?>
  </div>
</article>