<?php
define(THEMETXTDOMAIN, 'antonio-arruda');
define(THEMEROOT, get_template_directory_uri());
define(IMG, get_template_directory_uri() . '/img/');

// Utils
require_once "library/functions/utils.php";

// Remove
require_once "library/functions/remove.php";

// Title
require_once "library/functions/title.php";

// Custom Post
require_once "library/functions/custompost.php";

// Taxonomy
require_once "library/functions/taxonomy.php";

// menuTopoNav
require_once "library/classes/menu.php";

// Navs
require_once "library/functions/navs.php";

// Newsletter
require_once "library/functions/newsletter.php";

// Widgets
require_once "library/widgets/widgets.php";
