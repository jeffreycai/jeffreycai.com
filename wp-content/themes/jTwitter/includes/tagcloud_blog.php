<section class="tagcloud">
    <a href="<?php echo get_page_link(get_page_by_title('Blog')->ID) ?>" class="all">ALL</a>
    <?php wp_tag_cloud() ?>

    <span class="explain">
        displaying all blog posts
        <?php if (is_archive()): ?>
            <?php if (get_query_var('tag')): ?>
                with tag <strong><?php echo get_query_var('tag') ?></strong>
            <?php elseif (get_query_var('category_name')): ?>
                with category <strong><?php echo get_query_var('category_name') ?></strong>
            <?php endif ?>
        <?php endif ?>
    </span>
</section>