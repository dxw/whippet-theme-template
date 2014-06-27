<!-- TODO: Make WP load this template first -->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
</head>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

  <header class="banner container" role="banner">
    <div class="row">
      <div class="col-lg-12">
        <?php get_template_part('partials/menu'); ?>
      </div>
    </div>
  </header>

  <div class="wrap container" role="document">
    <div class="content row">
      <div class="main" role="main">
        <?php // TODO: replace roots_template_path(); ?>
      </div>
    </div>
  </div>

  <footer class="content-info container" role="contentinfo">
    <div class="row">
      <div class="col-lg-12">
        <?php dynamic_sidebar('sidebar-footer'); ?>
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>

</body>
</html>
