<section class="tagcloud">
    <a href="/portfolio" class="all">ALL</a>
    <?php wp_tag_cloud(array(
        'taxonomy' => 'portfolio_tags'
    )) ?>

    <span class="explain">
        displaying all portfolios
        <?php if (is_tax('portfolio_tags')): ?>
        with tag <strong><?php echo get_query_var('portfolio_tags') ?></strong>
        <?php endif ?>
    </span>
</section>
