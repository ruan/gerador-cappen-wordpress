<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="utf-8">
    <title><?php the_head_title(); ?></title>
    <meta name="description" content="">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-310x310.png" />

    <!-- fileblock:css css -->
    <!-- endfileblock -->
    <!-- process:remove:build -->
    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->

    <!-- endbower -->
    <!-- endbuild -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/styles/main.css">
    <!-- /process -->

    <?php wp_head(); ?>
</head>
<body>

    <header id="main-header">
        <div class="container">
            <a href="javascript:;" class="bt-menu-mobile">
                Open menu
                <span class="bt-menu-mobile__line --top"></span>
                <span class="bt-menu-mobile__line --middle"></span>
                <span class="bt-menu-mobile__line --bottom"></span>
            </a>
            <div id="main-menu">
                <?php if (has_nav_menu('menu')) : ?>
                    <?php get_template_part('templates/components/main-menu'); ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if (is_front_page()) :  ?>
            <?php get_template_part('templates/components/today-hour'); ?>
        <?php endif; ?>

        <div id="menu-mobile">
            <?php if (has_nav_menu('menu')) : ?>
                <?php get_template_part('templates/components/menu-mobile'); ?>
            <?php endif; ?>
        </div>
    </header>
    <div class="bg-menu-mobile"></div>
