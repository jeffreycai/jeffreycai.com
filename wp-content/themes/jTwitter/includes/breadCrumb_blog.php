<a href="<?php echo bloginfo('siteurl') ?>">Home</a>


<?php if (is_single() || is_archive() || is_tag()): ?>
    &gt; <a href="<?php echo get_permalink(get_page_by_title('blog')) ?>">Blog</a>
<?php else: ?>
    &gt; Blog
<?php endif ?>


<?php if ($tag = get_query_var('tag')): ?>
   &gt; <?php echo $tag ?>
<?php elseif($category = get_query_var('category_name')): ?>
    &gt; <?php echo $category ?>
<?php else: ?>
    &gt; <?php the_title() ?>
<?php endif ?>