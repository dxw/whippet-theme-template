<article>
  <header>
    <h1><?php the_title(); ?></h1>
  </header>

  <div class="entry content rich-text">
    <?php if(has_post_thumbnail()) :
        the_post_thumbnail('large');
       endif; ?>
    <?php the_content(); ?>
  </div>
</article>
