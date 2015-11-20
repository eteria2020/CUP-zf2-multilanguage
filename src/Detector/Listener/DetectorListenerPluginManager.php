<?php

namespace MvLabs\Multilanguage\Detector\Listener;

use MvLabs\Multilanguage\Exception\DetectorListenerNotFoundException;

use Zend\ServiceManager\AbstractPluginManager;

class DetectorListenerPluginManager extends AbstractPluginManager
{
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof LanguageDetectorListenerInterface) {
            throw new DetectorListenerNotFoundException();
        }
    }
}
