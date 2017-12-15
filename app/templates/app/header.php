<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <title><?php the_head_title(); ?></title>
    <meta name="description" content="">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Facebook -->
    <meta property="og:title" content="<?php the_head_title(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_bloginfo('url') ?>" />
    <meta property="og:image" content="<?php echo get_template_directory_uri();?>/img/share.jpg" />
    <meta property="og:description" content="<?php echo get_bloginfo('description') ?>" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php the_head_title(); ?>">
    <meta name="twitter:description" content="<?php echo get_bloginfo('description') ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri();?>/img/share.jpg">

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
  <?php get_template_part('templates/layouts/main-header'); ?>
