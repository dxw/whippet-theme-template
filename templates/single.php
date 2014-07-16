<div>
  <?php while (have_posts()) : the_post(); ?>

    <?php get_template_part('partials/article'); ?>

  <?php endwhile; ?>
</div>