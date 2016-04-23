<section id="topBar">
    <div class="content">
        <a class="logo" href="<?php bloginfo('siteurl') ?>" title="<?php bloginfo('blogname') ?>"><img src="<?php bloginfo('template_url') ?>/images/logo.png" alt="<?php bloginfo('blogname') ?>" /></a>
        <?php get_search_form() ?>
        <nav role="navigation">
            <span><a href="<?php echo get_home_url() ?>" class="<?php echo get_body_id() == 'home' ? 'current' : '' ?>"><?php echo __('Home', THEME_NAME) ?></a></span>
            <span><a href="<?php echo get_permalink(6) ?>" class="<?php echo get_body_id() == 'about' ? 'current' : '' ?>"><?php echo __('About', THEME_NAME) ?></a></span>
            <span><a href="/portfolio" class="<?php echo get_body_id() == 'portfolio' ? 'current' : '' ?>"><?php echo __('Portfolio', THEME_NAME) ?></a></span>
            <!-- <span><a href="<?php echo get_permalink(19) ?>" class="<?php echo get_body_id() == 'code' ? 'current' : '' ?>"><?php echo __('Code', THEME_NAME) ?></a></span>  -->
            <span><a href="<?php echo get_permalink(13) ?>" class="<?php echo get_body_id() == 'blog' ? 'current' : '' ?>"><?php echo __('Blog', THEME_NAME) ?></a></span>
            <span><a href="<?php echo get_permalink(16) ?>" class="<?php echo get_body_id() == 'contact' ? 'current' : '' ?>"><?php echo __('Contact', THEME_NAME) ?></a></span>
        </nav>
    </div>

        <div id="tip" style="display:<?php echo (has_flag_on('tip') && has_tip()) ? 'block' : 'none'; ?>">
            <div class="content">
                <p>
                <?php the_tip() ?>
                </p>
                <a href="#" class="stop action"><?php echo __('Turn off tips') ?></a>
            </div>
        </div>

</section>
<!-- end of #topBar -->

<section id="toolBar">
    <ul class="content">
        <li><a href="#" class="start action"><?php echo __('Turn on tips'); ?></a></li>
    </ul>
</section>


<section id="bodyWrap" style="top:<?php echo (has_flag_on('tip') && has_tip()) ? '0px' : '-40px' ?>">
    <section id="body">




        