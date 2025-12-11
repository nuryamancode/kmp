<?php

declare(strict_types=1);

use Flasher\Prime\Configuration;

return Configuration::from([
    // Set default notification theme
    'default' => 'theme.ios',

    // Register custom themes
    'themes' => [
        'theme.ios' => [
            'scripts' => [
                '/vendor/flasher/flasher.min.js',
                '/vendor/flasher/themes/theme.ios.min.js',
            ],
            'styles' => [
                '/vendor/flasher/flasher.min.css',
                '/vendor/flasher/themes/theme.ios.min.css',
            ],
        ],
    ],

    // Optional: inject assets automatically
    'inject_assets' => true,

    // Optional: translation support
    'translate' => true,
]);
