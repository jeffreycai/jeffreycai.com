<div class="tags">
    <span>categories:</span>
    <?php foreach (get_categories() as $category): ?>
        <a href="<?php echo get_category_link($category) ?>"><?php echo $category->name ?></a>
    <?php endforeach ?>
</div>