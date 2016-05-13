<header class="title col-md-9">
    <hgroup>
        <h1><?php echo h()->w_template_title(); ?></h1>
        <?php if (category_description()) :?>
            <h2><?php echo category_description(); ?></h2>
        <?php endif; ?>
    </hgroup>
</header>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('partials/article-list-item'); ?>
<?php endwhile; ?>
<?php endif; ?>

<div class="col-md-12">
    <?php get_template_part('partials/pager') ?>
</div>
