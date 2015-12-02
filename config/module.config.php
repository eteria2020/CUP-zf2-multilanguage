<?php

namespace MvLabsMultilanguage;

return [
    // we change the default router to allow route translation
    'router' => [
        'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack'
    ],
    'service_manager' => [
        'factories' => [
            'LanguageService' => 'MvLabsMultilanguage\Service\LanguageServiceFactory',
            'LanguageDetector' => 'MvLabsMultilanguage\Detector\LanguageDetectorFactory',
            'DetectLanguageRangeListener' => 'MvLabsMultilanguage\Detector\Listener\DetectLanguageRangeListenerFactory',
            'DetectorListenerPluginManager' => 'MvLabsMultilanguage\Detector\Listener\DetectorListenerPluginManagerFactory'
        ]
    ],
    // listeners used to detect the language range
    'language_detector_listeners' => [
        'invokables' => [
            'AcceptLanguageHeaderDetectorListener' => 'MvLabsMultilanguage\Detector\Listener\AcceptLanguageHeaderDetectorListener',
            'ReturnFirstValueDetectorListener' => 'MvLabsMultilanguage\Detector\Listener\ReturnFirstValueDetectorListener'
        ],
        'factories' => [
            'FilterByConfigurationDetectorListener' => 'MvLabsMultilanguage\Detector\Listener\FilterByConfigurationDetectorListenerFactory'
        ]
    ]
];
