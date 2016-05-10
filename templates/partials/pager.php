<?php if ($wp_query->max_num_pages > 1) : ?>

    <div class="pager">
        <?php \Dxw\MyTheme\Theme\Pagination::pagination(); ?>
    </div>

<?php endif; ?>
