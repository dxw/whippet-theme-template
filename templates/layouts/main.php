<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Prefetch external asset dns -->
  <link rel="dns-prefetch" href="#">

  <!-- Prefetch internal image assets -->
  <link rel="prefetch" href="#">

  <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory'); ?>/templates/assets/img/touch-icon.png">

  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/templates/assets/img/shortcut-icon.png" />

  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
</head>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

  <header class="banner" role="banner">
    <div class="row">
      <div class="logo"
        <a href="/"><h1><?php bloginfo('name'); ?></h1></a>
      </div>
    </div>
      <div class="row">
        <?php get_template_part('partials/nav'); ?>
      </div>
  </header>

  <main class="main" role="main">
    <?php w_requested_template(); ?>
  </main>

  <footer class="content-info" role="contentinfo">
    <div class="row">
      <?php dynamic_sidebar('sidebar-footer'); ?>
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
