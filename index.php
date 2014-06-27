<?php //TODO: Will this template pull through base.php?
if (!have_posts()) : ?>
  <div class="alert">
    <?php _e('Sorry, no results were found.', 'roots'); //TODO: Replace the domain everywhere ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>