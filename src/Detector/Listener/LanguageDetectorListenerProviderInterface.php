<?php

namespace MvLabsMultilanguage\Detector\Listener;

/**
 * interface needed to define the DetectorListenerPluginManager
 */
interface LanguageDetectorListenerProviderInterface
{
    public function getLanguageDetectorListenerConfig();
}
