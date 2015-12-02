<?php

namespace MvLabsMultilanguage\Detector\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventManagerInterface;

/**
 * the responsability of this class is to attach all the configured listeners
 * to the 'detectLanguageRange' event, so they are triggered to determine the
 * correct language range
 */
class DetectLanguageRangeListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var array $configListeners the listeners to be added defined in the
     * configuration
     */
    private $configListeners = [];

    /**
     * @var DetectorListenerPluginManager $detectorListenerPluginManager
     */
    private $detectorListenerPluginManager;

    /**
     * @param array $configListeners
     * @param DetectorListenerPluginManager $detectorListenerPluginManager
     */
    public function __construct(
        array $configListeners,
        DetectorListenerPluginManager $detectorListenerPluginManager
    ) {
        $this->configListeners = $configListeners;
        $this->detectorListenerPluginManager = $detectorListenerPluginManager;
    }

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        foreach ($this->configListeners as $listener) {
            $listenerClass = $this->detectorListenerPluginManager->get($listener);

            $this->listeners[] = $events->attach(
                'detectLanguageRange',
                [$listenerClass, 'detectLanguage']
            );
        }
    }
}
