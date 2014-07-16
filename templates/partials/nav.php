<nav class="navbar" role="navigation">
  <button data-target="#theme-nav-main" data-toggle="collapse" type="button" class="navbar-toggle">
    <span class="sr-only">Toggle navigation</span>
    Menu
  </button>
  <div id="theme-nav-main" class="navbar-collapse collapse" role="menu">
    <?php
      if (has_nav_menu('theme')) :
        wp_nav_menu(array('theme_location' => 'theme', 'menu_class' => 'nav navbar-nav'));
      endif;
    ?>
  </div>
</nav>
