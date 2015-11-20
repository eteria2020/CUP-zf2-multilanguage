<?php

namespace MvLabs\Multilanguage\Detector\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FilterByConfigurationDetectorListenerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sharedLocator = $serviceLocator->getServiceLocator();

        $allowedLanguages = $sharedLocator->get('Config')['multilanguage']['allowed_languages'];

        return new FilterByConfigurationDetectorListener($allowedLanguages);
    }
}
