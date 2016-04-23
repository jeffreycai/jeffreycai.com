<aside id="sidebar">
    <ul>
        <?php get_sidebar('introduce'); ?>

        <?php get_sidebar('twitter') ?>

        <?php get_sidebar('tech_used') ?>
        
        <?php 	/* Widgetized sidebar, if you have the plugin installed. */
        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>


        <?php if (is_user_logged_in()): ?>
        <li class="module"><h2><?php _e('Meta'); ?></h2>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
            </ul>
        </li>
        <?php endif ?>

        <?php endif; ?>
    </ul>
</aside>

