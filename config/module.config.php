<?php

namespace Multilanguage;

return [
    // we change the default router to allow route translation
    'router' => [
        'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack'
    ],
    'service_manager' => [
        'factories' => [
            'LanguageService' => 'MvLabs\Multilanguage\Service\LanguageServiceFactory',
            'LanguageDetector' => 'MvLabs\Multilanguage\Detector\LanguageDetectorFactory',
            'DetectLanguageRangeListener' => 'MvLabs\Multilanguage\Detector\Listener\DetectLanguageRangeListenerFactory',
            'DetectorListenerPluginManager' => 'MvLabs\Multilanguage\Detector\Listener\DetectorListenerPluginManagerFactory'
        ]
    ],
    'language_detector_listeners' => [
        'invokables' => [
            'AcceptLanguageHeaderDetectorListener' => 'MvLabs\Multilanguage\Detector\Listener\AcceptLanguageHeaderDetectorListener',
            'ReturnFirstValueDetectorListener' => 'MvLabs\Multilanguage\Detector\Listener\ReturnFirstValueDetectorListener'
        ],
        'factories' => [
            'FilterByConfigurationDetectorListener' => 'MvLabs\Multilanguage\Detector\Listener\FilterByConfigurationDetectorListenerFactory'
        ]
    ]
];
