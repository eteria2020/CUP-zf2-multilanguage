<?php

namespace MvLabsMultilanguage\Detector\Listener;

use MvLabsMultilanguage\Exception\DetectorListenerNotFoundException;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * plugin manager dedicater to language detector listeners
 */
class DetectorListenerPluginManager extends AbstractPluginManager
{
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof LanguageDetectorListenerInterface) {
            throw new DetectorListenerNotFoundException();
        }
    }
}
