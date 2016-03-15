<nav class="navigation" role="navigation">
  <button type="button" id="js-navigation-toggle" class="navigation-toggle">
    Menu
  </button>
    <?php
      if (has_nav_menu('theme')) :
        wp_nav_menu(array('theme_location' => 'theme', 'menu_class' => 'nav navbar-nav'));
      endif;
    ?>
</nav>
