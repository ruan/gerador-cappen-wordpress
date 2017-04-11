<?php
    $args = array(
        'post_type'      => 'blog',
        'posts_per_page' => 3
    );
    $blog_query = new WP_Query ( $args );
    if ( $blog_query -> have_posts() ) :
?>
<section id="home-blog">
    <div class="container">
        <?php while ( $blog_query -> have_posts() ) : $blog_query -> the_post(); ?>
            <?php get_template_part('templates/components/card-post'); ?>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>