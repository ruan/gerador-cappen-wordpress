<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="utf-8">
    <title><?php the_head_title(); ?></title>
    <meta name="description" content="">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

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
