<header id="main-header">
    <div class="container">
        <h1 class="logo">
            <a href="javascript:;" class="logo__link"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="<?php bloginfo('name'); ?>"></a>
        </h1>
        <a href="javascript:;" class="bt-menu-mobile">
            Abrir menu
            <span class="bt-menu-mobile__line --top"></span>
            <span class="bt-menu-mobile__line --middle"></span>
            <span class="bt-menu-mobile__line --bottom"></span>
        </a>
        <div id="menu">
            <?php if (has_nav_menu('menu')) : ?>
                <?php get_template_part('templates/components/main-menu'); ?>
            <?php endif; ?>
            <?php get_template_part('templates/components/social-media'); ?>
        </div>
    </div>
</header>
<div class="bg-menu-mobile"></div>
