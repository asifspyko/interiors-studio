<?php

// Add favicon
function site_favicon() { ?>
<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/favicon-16x16.png" sizes="16x16" />
<meta name="application-name" content="PROJECT_NAME"/>
<meta name="msapplication-TileColor" content="#fff" />
<meta name="msapplication-TileImage" content="<?php echo bloginfo('stylesheet_directory') ?>/assets/img/favicon/mstile-144x144.png" />
<?php }
add_action('wp_head', 'site_favicon');
