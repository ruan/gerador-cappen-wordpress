<?php 
    $image = (isset($image)) ? $image : '';
?>
<h1 class="logo">
    <span class="logo__link"><img src="<?php echo get_template_directory_uri();?>/img/logo<?php echo $image; ?>.svg" alt="<?php the_head_title(); ?>" class="logo__image"></span>
</h1>