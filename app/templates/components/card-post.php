<div class="card-post">
    <a href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <img class="card-post__image" src="<?php echo get_the_post_thumbnail_url(null,'post-thumb');?>">
        <?php endif ?>
        <h2 class="card-post__title"><?php the_title(); ?></h2>
        <time class="card-post__date"><?php echo get_the_date(); ?></time>
        <p class="card-post__description"><?php echo get_the_excerpt(); ?></p>
        <span class="card-post__link">Leia mais</span>
    </a>
</div>