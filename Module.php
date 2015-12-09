<?php

namespace MvLabsMultilanguage;

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

        // we try to detect the language only if the request is an Http request.
        // We do not consider console requests
        if (!$e->getRequest() instanceof HttpRequest) {
            return;
        }

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

                // moreover, we set the translator to be used when translating
                // form error messages
                AbstractValidator::setDefaultTranslator($languageService->getTranslator());
            },
            100
        );

        // attach DetectLanguageRangeListener, used in setLanguageFromRequest
        $detectLanguageRangeListener = $serviceManager->get('DetectLanguageRangeListener');
        $eventManager->attach($detectLanguageRangeListener);
    }

    public function init(ModuleManager $moduleManager)
    {
        // add a new service manager to manage the language detector listeners
        $serviceManager = $moduleManager->getEvent()->getParam('ServiceManager');
        $serviceLister = $serviceManager->get('ServiceListener');

        $serviceLister->addServiceManager(
            'DetectorListenerPluginManager',
            'language_detector_listeners',
            'MvLabsMultilanguage\Detector\Listener\LanguageDetectorListenerProviderInterface',
            'getLanguageDetectorListenerConfig'
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
