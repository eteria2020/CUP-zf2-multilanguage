<?php

namespace MvLabsMultilanguage\Detector;

use MvLabsMultilanguage\LanguageRange\LanguageRangeInterface;
use MvLabsMultilanguage\Exception\LanguageRangeNotDetectedException;
use MvLabsMultilanguage\Event\DetectLanguageEventFactory;

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
        // we create a DetectLanguageEvent
        // it will be used to keep track of the progress in the definition of
        // the language range to be used
        $event = DetectLanguageEventFactory::createEvent($request);

        // we throw an event to detect the correct language range
        // the listeners of this event will actually perform the hard work
        $languageRanges = $this->events->trigger(
            __FUNCTION__,
            $this,
            $event,
            [$this, 'detectorCallback']
        );

        // if no language was detected we throw an exception
        if (!$languageRanges->stopped()) {
            throw new LanguageRangeNotDetectedException();
        }

        return $languageRanges->last();
    }

    /**
     * checks if the returned result of an attached callback to the event
     * triggered if the detectLanguageRange method is a LanguageRange and in
     * that case it stops the propagation of the event
     *
     * @param mixed $result
     * @return bool
     */
    public function detectorCallback($result)
    {
        return $result instanceof LanguageRangeInterface;
    }
}
