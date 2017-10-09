<?php

define('THEMETXTDOMAIN', 'cavora');
define('THEMEROOT', get_template_directory_uri());
define('IMG', get_template_directory_uri() . '/img/');

// Utils
require_once 'library/functions/utils.php';

// Remove
require_once 'library/functions/remove.php';

// Title
require_once 'library/functions/title.php';

// Custom Post
require_once 'library/functions/custompost.php';

// Taxonomy
require_once 'library/functions/taxonomy.php';

// Menu
require_once 'library/classes/menu.php';

// Navs
require_once 'library/functions/navs.php';

// Widgets
require_once 'library/widgets/widgets.php';
