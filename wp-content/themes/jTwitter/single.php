<?php
get_header();
the_post();
global $post;
?>


<section id="mainContent">
    <header id="profileBox">
        <h1><?php the_title() ?></h1>

        <div class="post-info-top">
            <span class="post-info-date">Posted by <?php the_author(); ?> on <?php the_time(get_option( 'date_format' )); ?> <?php edit_post_link('Edit', '[', ']'); ?></span>
        </div>

        <?php if ($url = get_post_custom_values('Url')): $url = array_shift($url); ?>
        <p><a href="<?php echo $url ?>" target="_blank" title="<?php the_title() ?>"><?php echo $url ?></a></p>
        <?php endif ?>

        <?php if (get_post_custom_values('Profile')): ?>
            <?php echo wp_get_attachment_image(array_shift(get_post_custom_values('Profile')), '', false, array('title' => get_the_title())) ?>
        <?php endif ?>
        <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'ProfileText', true)) ?>
    </header>

    <nav class="breadCrumb">
        <?php include_theme_file('breadCrumb_blog.php') ?>
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

        <?php the_content() ?>

        <?php include_theme_file('blog_tags.php') ?>

        </article>
    </section>
    <?php endif ?>


</section>
<!-- end of #mainContent -->

    <?php get_sidebar(); ?>

<?php get_footer(); ?>
