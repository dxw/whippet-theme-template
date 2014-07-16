<article <?php post_class('article'); ?>>

  <header class="col-md-12">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php get_template_part('partials/entry-meta'); ?>
  </header>

  <div class="entry col-md-9">
    <div class="entry-contain">
      <?php if(has_post_thumbnail()) :
          the_post_thumbnail('large');
         endif; ?>
      <?php the_content(); ?>
      <aside class="footnotes">
        <?php the_footnotes(); ?>
      </aside>
    </div>

    <?php if(have_rows('more_information')) : ?>
      <footer>
        <h1>Related</h1>
        <ul>
          <?php while(have_rows('more_information')): the_row(); ?>
            <li><a href="<?php the_sub_field('url'); ?>" title="<?php the_sub_field('link_title'); ?>"><?php the_sub_field('link_title'); ?></a>
              <span><?php the_sub_field('link_description'); ?></span></li>
          <?php endwhile; ?>
        </ul>
      </footer>
    <?php endif; ?>
  </div>

  <aside id="sidebar" class="col-md-3">
    <div class="side-contain">
      <?php get_template_part('partials/category-list'); ?>

      <div class="share">
      <h2>Share</h2>
        <?php sharethis_btns(); ?>
      </div>
    </div>
  </aside>

</article>
