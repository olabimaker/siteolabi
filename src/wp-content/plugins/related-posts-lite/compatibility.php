<?php
/**
 * Defines the compatibility tests.
 *
 * Include this file to perform the compatibility tests. Use require_once.
 */
$_comp = wpdreamsCompatibility::Instance();
$_comp->check_dir_w(
    RPL_PATH . 'css' . DIRECTORY_SEPARATOR,
    "You might not be able to change the layout style."
);
$_comp->check_dir_w(
    RPL_PATH . 'cache' . DIRECTORY_SEPARATOR,
    "Images may not show in results."
);
$_comp->can_open_url("Images may not show in results.");
?>