<article <?php post_class('article'); ?>>

    <header class="col-md-12">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part('partials/entry-meta'); ?>
    </header>

    <div class="entry col-md-9">
        <div class="entry-contain">
            <?php if (has_post_thumbnail()) :
            the_post_thumbnail('large');
            endif; ?>
            <?php the_content(); ?>
        </div>
    </div>
</article>
