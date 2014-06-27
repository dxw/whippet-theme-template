<?php while (have_posts()) : the_post(); ?>

  <header>
    <h1><?php the_title(); ?></h1>
  </header>

  <?php get_template_part('partials/article'); ?>

  <?php if (comments_open() && post_type_supports(get_post_type(), 'comments')) : // TODO: I wrote this without testing. Doth it worketh?
    comments_template('templates/comments'); // TODO: Is comments_template a WP function? Wassit do?
  else : ?>
    <div class="alert">
      <?php _e('Comments are closed.', 'roots'); ?>
    </div>
  <?php endif; ?>

<?php endwhile; ?>
