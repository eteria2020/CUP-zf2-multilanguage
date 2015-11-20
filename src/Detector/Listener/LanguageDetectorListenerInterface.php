<?php

namespace MvLabs\Multilanguage\Detector\Listener;

use MvLabs\Multilanguage\Event\DetectLanguageEventInterface;

interface LanguageDetectorListenerInterface
{
    /**
     * Uses the provided the event to manage the event LanguageRange
     * Returns either an array of PriorityQueues of LanguageRanges or a single
     * LanguageRange, if it is the one to be used in the application without
     * needing further processing
     *
     * @param DetectLanguageEventInterface $event
     * @return LanguageRange|PriorityQueue
     */
    public function detectLanguage(DetectLanguageEventInterface $event);
}
