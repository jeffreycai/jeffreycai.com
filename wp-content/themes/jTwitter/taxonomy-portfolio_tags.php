<?php
get_header();

$page = get_page_by_title('portfolio');
//echo "<pre>";var_dump($page);die("</pre>");

$wp_query->query_vars['offset'] = get_offset();
$wp_query->query_vars['orderby'] = 'menu_order';
$wp_query->query_vars['order'] = 'DESC';
$loop = new WP_Query($wp_query->query_vars);
?>


<section id="mainContent">
    <header id="profileBox">
        <?php if (get_post_custom_values('Profile', $page->ID)): ?>
            <?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile', $page->ID)), '', false, array('title' => $page->post_title)) ?>
        <?php endif ?>
        <?php echo apply_filters('the_content', get_post_meta($page->ID, 'ProfileText', true)) ?>

        <?php include_theme_file('switch.php') ?>

    </header>

    <div class="breadCrumb">
        <?php include_theme_file('breadCrumb.php') ?>
        <nav class="pagination">
            <?php paginate($wp_query->query_vars, '/'.$wp_query->queried_object->taxonomy.'/'.$wp_query->queried_object->slug) ?>
        </nav>
    </div>

    <?php include_theme_file('tagcloud_portfolio.php') ?>

    <section class="subpages" id="list">

        <?php while ($loop->have_posts()): $loop->the_post(); ?>
            <article class="item slidable <?php echo 'postID'.get_the_ID() ?>">

                <?php if (sizeof(get_post_custom_values('Featured'))): ?>
                    <img class="featured" src="<?php bloginfo('template_url') ?>/images/featured.png" alt="featured" />
                <?php endif ?>

                <a href="#" class="arrow <?php if (!has_flag_on('switch')): ?>hide<?php endif ?>"></a>

                <h2><?php the_title() ?></h2>

                <?php if ($post->menu_order): ?>
                    <img class="rating" width="100" src="<?php bloginfo('template_url') ?>/images/<?php echo $post->menu_order  > 5 ? 5 : $post->menu_order?>stars.png" alt="<?php echo $post->menu_order  > 5 ? 5 : $post->menu_order ?> star project" title="<?php echo $post->menu_order  > 5 ? 5 : $post->menu_order ?> star project" />
                <?php endif ?>

                <a class="thumbnail" href="<?php echo get_permalink(get_the_ID()) ?>" title="<?php the_title() ?>"><?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile', get_the_ID())), array(60,60), false, array('title' => get_the_title())) ?></a>
                <?php echo str_replace('h1', 'h2', apply_filters('the_content', array_shift(get_post_custom_values('ProfileText', get_the_ID())))); ?>

                <?php include_theme_file('portfolio_tags.php') ?>
            </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </section>

    <div class="breadCrumb">
        <nav class="pagination">
            <?php paginate($wp_query->query_vars, '/'.$wp_query->queried_object->taxonomy.'/'.$wp_query->queried_object->slug) ?>
        </nav>
    </div>
</section>
<!-- end of #mainContent -->

<?php get_sidebar(); ?>

<?php include_theme_file('sliding.php') ?>

<?php get_footer(); ?>
