<?php

// Load the theme/plugin options
if (is_user_logged_in() && file_exists(dirname(__FILE__) . '/options-init.php')) {
    require_once dirname(__FILE__) . '/options-init.php';
}
