<?php

function whippet_template() {
  require(Whippet\Layout::$wordpress_template);
}

function whippet_template_warning() {
  ?>
  <div class="whippet alert template-warning" style="background: rgb(255,100,100); width: 100%; padding: 10px;"><h1>You're using a fallback template: <?php echo basename(Whippet\Layout::$wordpress_template); ?></h1> <p>Did you really mean to? If you can, define a specific template and use it. Like single-post.php.</p></div>
  <?php
}
