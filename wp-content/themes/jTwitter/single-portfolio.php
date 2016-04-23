<?php
get_header();
the_post();
global $post;
?>


<section id="mainContent">
    <header id="profileBox">
        <?php if (sizeof(get_post_custom_values('Featured'))): ?>
            <img class="featured" src="<?php bloginfo('template_url') ?>/images/featured.png" alt="featured" />
        <?php endif ?>

        <h1><?php the_title() ?></h1>

        <?php if ($post->menu_order): ?>
            <img class="rating" src="<?php bloginfo('template_url') ?>/images/<?php echo $post->menu_order  > 5 ? 5 : $post->menu_order ?>stars.png" alt="<?php echo $post->menu_order  > 5 ? 5 : $post->menu_order ?> star project" title="<?php echo $post->menu_order  > 5 ? 5 : $post->menu_order?> star project" />
        <?php endif ?>

        <?php if ($url = get_post_custom_values('Url')): $url = array_shift($url); ?>
        <p><a href="<?php echo $url ?>" target="_blank" title="<?php the_title() ?>"><?php echo $url ?></a></p>
        <?php endif ?>

        <?php if (get_post_custom_values('Profile')): ?>
            <?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile')), '', false, array('title' => get_the_title())) ?>
        <?php endif ?>

        <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'ProfileText', true)) ?>
    </header>

    <nav class="breadCrumb">
        <?php include_theme_file('breadCrumb_portfolio.php') ?>
    </nav>

    <?php if (!is_empty_html(get_the_content())): ?>
    <section id="content">
        <article class="inner">

        <?php if ($imgs = get_post_custom_values('ProfileLarge')): ?>
            <h2>Screenshots:</h2>
            <div id="slider">
            <?php foreach ($imgs as $img): ?>
                <?php echo wp_get_attachment_image($img, '', false, array('title' => '')) ?>
            <?php endforeach ?>
            </div>
        <?php endif ?>

        <h2>Project Description:</h2>
        <?php the_content() ?>
        <div class="quote">
            <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'ProfileText', true)) ?>
        </div>

        <div  class="copyright">
        <?php if ($customized_copyright = get_post_custom_values('CustomizedCopyright')): $customized_copyright = array_shift($customized_copyright); ?>
            <?php if (!is_empty_html($customized_copyright)): ?>
                <?php echo apply_filters('the_content', $customized_copyright); ?>
            <?php endif ?>
        <?php elseif ($copyright = get_post_custom_values('Copyright')): $copyright = array_shift($copyright); ?>
            <?php if ($copyright == 'Jimmyweb'): ?>
            <p>&copy; This is a Jimmyweb project. All rights reserved by <a href="">Jimmyweb Pty Ltd.</a></p>
            <?php endif ?>
        <?php endif ?>
        </div>

        <?php include_theme_file('portfolio_tags.php') ?>

        <?php // include_theme_file('next_pre_post.php') ?>

        </article>
    </section>
    <?php endif ?>

</section>
<!-- end of #mainContent -->

    <?php get_sidebar(); ?>

<?php get_footer(); ?>
