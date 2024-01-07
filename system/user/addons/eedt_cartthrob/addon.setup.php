<?php

if (!defined('DEBUG_TOOLBAR_CARTTHROB_ADDON_NAME')) {
    define('DEBUG_TOOLBAR_CARTTHROB_ADDON_NAME', 'Debug Toolbar - CartThrob');
}

if (!defined('DEBUG_TOOLBAR_CARTTHROB_VERSION')) {
    define('DEBUG_TOOLBAR_CARTTHROB_VERSION', '2.0.0');
}

return [
    'author' => 'mithra62',
    'author_url' => 'https://github.com/mithra62/ee_debug_toolbar',
    'docs_url' => 'https://github.com/mithra62/ee_debug_toolbar/wiki',
    'name' => DEBUG_TOOLBAR_CARTTHROB_ADDON_NAME,
    'description' => 'Displays details about your CartThrob site in the Toolbar.',
    'version' => DEBUG_TOOLBAR_CARTTHROB_VERSION,
    'namespace' => 'DebugToolbar\CartThrob',
    'settings_exist' => false
];
