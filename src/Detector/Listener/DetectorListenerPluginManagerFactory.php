<?php

namespace MvLabs\Multilanguage\Detector\Listener;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

class DetectorListenerPluginManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'MvLabs\Multilanguage\Detector\Listener\DetectorListenerPluginManager';
}
