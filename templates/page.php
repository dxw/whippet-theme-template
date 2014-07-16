<div>
  <?php while (have_posts()) : the_post(); ?>

    <?php get_template_part('partials/page'); ?>

  <?php endwhile; ?>
</div>