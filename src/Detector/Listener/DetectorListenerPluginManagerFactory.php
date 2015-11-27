<?php

namespace MvLabsMultilanguage\Detector\Listener;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

class DetectorListenerPluginManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'MvLabsMultilanguage\Detector\Listener\DetectorListenerPluginManager';
}
