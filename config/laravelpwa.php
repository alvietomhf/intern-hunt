<?php

return [
    'name' => 'LaravelPWA',
    'manifest' => [
        'name' => 'Hunting Intern',
        'short_name' => 'Hunting Intern',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#324ECF',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> '#324ECF',
        'icons' => [
            '72x72' => [
                'path' => '/assets/pwa/logo/72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/assets/pwa/logo/96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/assets/pwa/logo/128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/assets/pwa/logo/144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/assets/pwa/logo/152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/assets/pwa/logo/192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/assets/pwa/logo/384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/assets/pwa/logo/512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/assets/pwa/splash/640x1136.png',
            '750x1334' => '/assets/pwa/splash/750x1334.png',
            '828x1792' => '/assets/pwa/splash/828x1792.png',
            '1125x2436' => '/assets/pwa/splash/1125x2436.png',
            '1242x2208' => '/assets/pwa/splash/1242x2208.png',
            '1242x2688' => '/assets/pwa/splash/1242x2688.png',
            '1536x2048' => '/assets/pwa/splash/1536x2048.png',
            '1668x2224' => '/assets/pwa/splash/1668x2224.png',
            '1668x2388' => '/assets/pwa/splash/1668x2388.png',
            '2048x2732' => '/assets/pwa/splash/2048x2732.png',
        ],
        'shortcuts' => [],
        'custom' => []
    ]
];
