<?php
get_header();

//// loop through all portfolio
$args = array(
    'post_type' => 'portfolio',
    'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'DESC',
//        'showposts' => 5,
    'offset' => get_offset()
);
$loop = new WP_Query($args);
?>

<section id="mainContent">
    <header id="profileBox">
        <?php if (get_post_custom_values('Profile')): ?>
            <?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile')), '', false, array('title' => get_the_title())) ?>
        <?php endif ?>
        <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'ProfileText', true)) ?>

        <?php include_theme_file('switch.php') ?>
    </header>

<nav class="breadCrumb">
    <?php include_theme_file('breadCrumb.php') ?>
        <nav class="pagination">
            <?php paginate($args, '/'.$wp_query->query_vars['pagename']) ?>
        </nav>
</nav>

    <?php include_theme_file('tagcloud_portfolio.php') ?>


    <section class="subpages" id="list">
        <?php while ($loop->have_posts()): $loop->the_post(); ?>
            <div class="item slidable <?php echo 'postID'.get_the_ID() ?>">

                <?php if (sizeof(get_post_custom_values('Featured'))): ?>
                    <img class="featured" src="<?php bloginfo('template_url') ?>/images/featured.png" alt="featured" />
                <?php endif ?>

                <a href="#" class="arrow <?php if (!has_flag_on('switch')): ?>hide<?php endif ?>"></a>

                <h2><?php the_title() ?></h2>

                <?php if ($post->menu_order): ?>
                    <img class="rating" width="100" src="<?php bloginfo('template_url') ?>/images/<?php echo $post->menu_order > 5 ? 5 : $post->menu_order ?>stars.png" alt="<?php echo $post->menu_order ?> star project" title="<?php echo $post->menu_order  > 5 ? 5 : $post->menu_orde?> star project" />
                <?php endif ?>

                <a class="thumbnail" href="<?php echo get_permalink(get_the_ID()) ?>" title="<?php the_title() ?>"><?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile', get_the_ID())), array(60,60), false, array('title' => get_the_title())) ?></a>
                <?php echo str_replace('h1', 'h2', apply_filters('the_content', array_shift(get_post_custom_values('ProfileText', get_the_ID())))); ?>

                <?php include_theme_file('portfolio_tags.php') ?>

                
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </section>

    <div class="breadCrumb">
        <?php include_theme_file('breadCrumb.php') ?>
        <nav class="pagination">
            <?php paginate($args, '/'.$wp_query->query_vars['pagename']) ?>
        </nav>
    </div>
    
</section>
<!-- end of #mainContent -->

<?php get_sidebar(); ?>

<?php include_theme_file('sliding.php') ?>

<?php get_footer(); ?>


