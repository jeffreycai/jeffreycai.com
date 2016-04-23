<?php
get_header();
the_post();
global $post;
?>


<div id="mainContent">
    <?php include_theme_file('breadCrumb.php') ?>

    <div id="profileBox">
        <?php if (get_post_custom_values('Profile')): ?>
            <?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile')), '', false, array('title' => '')) ?>
        <?php endif ?>
        <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'ProfileText', true)) ?>
    </div>

    <?php if (!is_empty_html(get_the_content())): ?>
    <div class="content">
        <?php echo the_content() ?>
    </div>
    <?php endif ?>

    <?php
        $subpages;
        // if it has children, display list of his children
        if (count($subpages = get_pages('child_of='.get_the_ID().'&hierarchical=0&sort_column=menu_order'))):
    ?>
        <?php foreach ($subpages as $subpage): ?>
            <div>
                <?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile', $subpage->ID)), array(80,80), false, array('width' => '80', 'title' => '')) ?>
            </div>
        <?php endforeach ?>
    <?php
        // else, display it's subling
        elseif (count($subpages = get_pages('child_of='.$post->post_parent.'&sort_column=menu_order')) && $post->post_parent):
    ?>
    <nav id="subnav">
        <?php foreach($subpages as $subpage): ?>
            <span><a href="<?php echo get_permalink($subpage->ID) ?>"><?php echo $subpage->post_title ?></a></span>
        <?php endforeach ?>
    </nav>
    <?php endif ?>

</div>
    <!-- end of #mainContent -->

    <?php get_sidebar(); ?>

<?php get_footer(); ?>