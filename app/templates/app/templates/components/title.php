<h2 class="title">
    <?php $icon = (isset($icon)) ? $icon : ''; ?>
    <?php if($icon != '') : ?>
    <img class="title__icon" src="<?php echo get_template_directory_uri();?>/img/icons/<?php echo $icon; ?>.svg" >
    <?php endif; ?>
    <?php the_title(); ?>
</h2>