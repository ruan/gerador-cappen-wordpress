<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="utf-8">
    <title><?php the_head_title(); ?></title>
    <meta name="description" content="">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/img/favicon.png">
    <!-- process:[href]:build <?=get_template_directory_uri();?>/styles/ -->
    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->
    <!-- endbower -->
    <!-- endbuild -->
    <!-- build:css styles/main.css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/styles/main.css">
    <!-- endbuild -->
    <!-- /process -->
    <!-- process:[src]:build <?=get_template_directory_uri();?>/scripts/ -->
    <!-- build:js scripts/modernizr.js -->
    <script src="<?php echo get_template_directory_uri();?>/../../../../bower_components/modernizr/modernizr.js"></script>
    <!-- endbuild -->
    <!-- /process -->
    <?php wp_head(); ?>
</head>
<body>
    <!--[if lt IE 10]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <header id="main-header">
        <div class="container">
            <?php get_template_part('templates/components/logo'); ?>
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
                <?php if (is_active_sidebar('widget-redessociais')) : ?>
                    <?php get_template_part('templates/components/social-media'); ?>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <div class="bg-menu-mobile"></div>
