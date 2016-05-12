<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

    <header class="banner" role="banner">
        <div class="header-contain">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <a href="/"><h1 class="brand"><?php bloginfo('name'); ?></h1></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php get_template_part('partials/nav'); ?>
            </div>
        </div>
    </header>

    <div class="wrap container" role="document">
        <div class="content row">
            <div class="main" role="main">
                <?php \Dxw\MyTheme\Registrar::getSingleton()->getInstance('Dxw\\MyTheme\\Helpers')->w_requested_template(); ?>
            </div>
        </div>
    </div>

    <footer class="content-info" role="contentinfo">
        <div class="container">
            <?php dynamic_sidebar('sidebar-footer'); ?>
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
