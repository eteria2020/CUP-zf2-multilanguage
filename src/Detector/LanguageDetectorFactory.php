<?php

namespace MvLabsMultilanguage\Detector;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class LanguageDetectorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $events = $serviceLocator->get('Application')->getEventManager();

        return new LanguageDetector($events);
    }
}
