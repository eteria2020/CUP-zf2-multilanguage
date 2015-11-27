<?php

namespace MvLabsMultilanguage\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LanguageServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Multilanguage\Service\LanguageService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $translatorService = $serviceLocator->get('MvcTranslator');
        $languageDetector = $serviceLocator->get('LanguageDetector');
        $eventManager = $serviceLocator->get('Application')->getEventManager();

        return new LanguageService(
            $translatorService,
            $languageDetector,
            $eventManager
        );
    }
}
