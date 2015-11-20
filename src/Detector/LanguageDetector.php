<?php

namespace MvLabs\Multilanguage\Detector;

use MvLabs\Multilanguage\LanguageRange\LanguageRange;
use MvLabs\Multilanguage\Exception\LanguageRangeNotDetectedException;
use MvLabs\Multilanguage\Event\DetectLanguageEventFactory;

use Zend\Http\Request;
use Zend\EventManager\EventManagerInterface;

class LanguageDetector implements LanguageDetectorInterface
{
    /**
     * private EventManagerInterface $eventManager;
     */
    private $events;

    /**
     * @param EventManagerInterface $eventManager
     */
    public function __construct(EventManagerInterface $events)
    {
        $this->events = $events;
    }

    /**
     * @inheritdoc
     */
    public function detectLanguageRange(Request $request)
    {
        $event = DetectLanguageEventFactory::createEvent($request);

        $languageRanges = $this->events->trigger(
            __FUNCTION__,
            $this,
            $event,
            [$this, 'detectorCallback']
        );

        if (!$languageRanges->stopped()) {
            throw new LanguageRangeNotDetectedException();
        }

        return $languageRanges->last();
    }

    /**
     * checks if the returned result of an attached callback to the event
     * triggered if the detectLanguageRange method is a Language range and in
     * that case it stops the propagation of the event
     *
     * @param mixed $result
     * @return bool
     */
    public function detectorCallback($result)
    {
        return $result instanceof LanguageRange;
    }
}
