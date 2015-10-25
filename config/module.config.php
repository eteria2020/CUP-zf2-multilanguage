<?php

namespace Multilanguage;

return [
    'router' => [
        'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack'
    ],
    'service_manager' => [
        'factories' => [
            'LanguageService' => 'MvLabs\Multilanguage\Service\LanguageServiceFactory',
            'DetectLocaleService' => 'MvLabs\Multilanguage\Service\DetectLocaleServiceFactory'
        ]
    ],
    'translator' => [
        'locale' => 'it_IT',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
            [
                'type' => 'phparray',
                'base_dir'    => __DIR__ . '/../language/validators',
                'pattern'     => '%s.php',
                'text_domain' => 'default'
            ]
        ],
    ],
];
