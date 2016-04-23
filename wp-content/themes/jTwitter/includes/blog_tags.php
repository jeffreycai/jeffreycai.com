<div class="tags">
    <span>tags:</span>
    <?php foreach (get_tags() as $tag): ?>
        <a href="<?php echo get_tag_link($tag) ?>"><?php echo $tag->name ?></a>
    <?php endforeach ?>
</div>