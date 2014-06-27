<header>
  <h1><?php echo roots_title(); ?></h1>
</header>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('partials/article-list-item'); ?>
  <?php endwhile; ?>
<?php endif; ?>