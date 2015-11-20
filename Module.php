<?php

namespace Multilanguage;

use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;
use Zend\Http\Request as HttpRequest;
use Zend\ModuleManager\ModuleManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $serviceManager = $e->getApplication()->getServiceManager();
        $languageService = $serviceManager->get('LanguageService');

        //set translator to be used when translating form error messages
        AbstractValidator::setDefaultTranslator($languageService->getTranslator());

        // before the routing happens we assign to the router a translator so
        // that we can translate urls
        $eventManager->attach(
            MvcEvent::EVENT_ROUTE,
            function (MvcEvent $e) use ($languageService) {
                // first thing we need to set the correct locale
                $languageService->setLanguageFromRequest($e->getRequest());

                // next we give to the router the translator to use to perform
                // the url translation
                $e->getRouter()->setTranslator($languageService->getTranslator(), 'routes');
            },
            100
        );

        // attach DetectLanguageRangeListener
        $detectLanguageRangeListener = $serviceManager->get('DetectLanguageRangeListener');

        $eventManager->attach($detectLanguageRangeListener);
    }

    public function init(ModuleManager $moduleManager)
    {
        $serviceManager = $moduleManager->getEvent()->getParam('ServiceManager');
        $serviceLister = $serviceManager->get('ServiceListener');

        $serviceLister->addServiceManager(
            'DetectorListenerPluginManager',
            'language_detector_listeners',
            'MvLabs\Multilanguage\Detector\Listener\LanguageDetectorListenerProviderInterface',
            'getLanguageDetectorListenerConfig'
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
