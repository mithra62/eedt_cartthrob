<?php

if (!defined('DEBUG_TOOLBAR_CARTTHROB_ADDON_NAME')) {
    define('DEBUG_TOOLBAR_CARTTHROB_ADDON_NAME', 'Debug Toolbar - CartThrob');
}

if (!defined('DEBUG_TOOLBAR_CARTTHROB_VERSION')) {
    define('DEBUG_TOOLBAR_CARTTHROB_VERSION', '1.0.0');
}

use DebugToolbar\CartThrob\Services\PanelService;
use DebugToolbar\CartThrob\Services\GiftCertificateService;
use DebugToolbar\CartThrob\Services\FeesService;

return [
    'author' => 'mithra62',
    'author_url' => 'https://github.com/mithra62/ee_debug_toolbar',
    'docs_url' => 'https://github.com/mithra62/ee_debug_toolbar/wiki',
    'name' => DEBUG_TOOLBAR_CARTTHROB_ADDON_NAME,
    'description' => 'Displays details about your CartThrob site in the Toolbar.',
    'version' => DEBUG_TOOLBAR_CARTTHROB_VERSION,
    'namespace' => 'DebugToolbar\CartThrob',
    'settings_exist' => false,
    'services' => [
        'PanelService' => function ($addon) {
            ee()->load->add_package_path(PATH_THIRD . 'cartthrob/');
            ee()->lang->loadfile('eedt_cartthrob');
            return new PanelService();
        },
        'GiftCertificateService' => function ($addon) {
            ee()->load->add_package_path(PATH_THIRD . 'cartthrob/');
            ee()->lang->loadfile('eedt_cartthrob');
            return new GiftCertificateService();
        },
        'FeesService' => function ($addon) {
            ee()->load->add_package_path(PATH_THIRD . 'cartthrob_fees/');
            ee()->lang->loadfile('eedt_cartthrob');
            return new FeesService();
        },
    ],
];

