<?php

namespace MvLabsMultilanguage\Detector\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DetectLanguageRangeListenerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return DetectLanguageRangeListener
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configListeners = $serviceLocator->get('Config')['multilanguage']['listeners'];
        $detectorListenerPluginManager = $serviceLocator->get('DetectorListenerPluginManager');

        return new DetectLanguageRangeListener(
            $configListeners,
            $detectorListenerPluginManager
        );
    }
}
