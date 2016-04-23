<?php
get_header();
the_post();
global $post;

$subpages = is_front_page() ? get_pages('parent=0&hierarchical=0&sort_column=menu_order&exclude_tree=2') : get_pages('child_of='.get_the_ID().'&hierarchical=0&sort_column=menu_order');
?>


<section id="mainContent">
    <header id="profileBox">
        <?php if (get_post_custom_values('Profile')): ?>
            <?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile')), '', false, array('title' => get_the_title())) ?>
        <?php endif ?>
        <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'ProfileText', true)) ?>

        <?php if ($post->post_parent == 0): // only show swith for level 0 pages ?>
            <?php include_theme_file('switch.php') ?>
        <?php endif ?>
    </header>

    <?php if (count($subpages) && !is_empty_html(get_the_content())): ?>
    <section id="content">
        <article class="inner">
        <?php the_content() ?>
        </article>
    </section>
    <?php endif ?>

    <nav class="breadCrumb">
        <?php include_theme_file('breadCrumb.php') ?>
    </nav>

    <?php
        // if it has children, display list of his children
        if (count($subpages)):
    ?>
    <section class="subpages" id="list">
        <?php foreach ($subpages as $subpage):?>
        <div class="item <?php if (!is_slidable($subpage->ID)): ?>un<?php endif ?>slidable <?php echo 'postID'.$subpage->ID ?>">
                
                <a href="#" class="arrow <?php if (!has_flag_on('switch')): ?>hide<?php endif ?>"></a>

                <a class="thumbnail" href="<?php echo get_permalink($subpage->ID) ?>" title="<?php echo $subpage->post_title ?>"><?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile', $subpage->ID)), array(60,60), false, array('title' => get_the_title())) ?></a>
                <?php echo str_replace('h1', 'h2', apply_filters('the_content', array_shift(get_post_custom_values('ProfileText', $subpage->ID)))); ?>
            </div>
        <?php endforeach ?>
    </section>
    <?php
        // else, display it's subling
        elseif (count($subpages = get_pages('child_of='.$post->post_parent.'&sort_column=menu_order')) && $post->post_parent):
    ?>
    <!--
    <nav id="subnav">
        <?php foreach($subpages as $subpage): ?>
            <span><a class="<?php echo $subpage->post_title == $post->post_title ? 'current' : '' ?>" href="<?php echo get_permalink($subpage->ID) ?>"><?php echo $subpage->post_title ?></a></span>
        <?php endforeach ?>
    </nav>
    -->
    <?php endif ?>

    <?php if (!is_front_page()): ?>
    <section id="content">
        <article class="inner">
        <?php the_content() ?>
        </article>
    </section>
    <?php endif ?>

    <div class="breadCrumb">

    </div>
</section>
<!-- end of #mainContent -->

<?php get_sidebar(); ?>

<?php include_theme_file('sliding.php') ?>

<?php get_footer(); ?>
