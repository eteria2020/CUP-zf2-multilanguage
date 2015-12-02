<?php

namespace MvLabsMultilanguage\Detector\Listener;

use MvLabsMultilanguage\Event\DetectLanguageEventInterface;

class ReturnFirstValueDetectorListener implements LanguageDetectorListenerInterface
{
    /**
     * @inheritdoc
     */
    public function detectLanguage(DetectLanguageEventInterface $event)
    {
        // just return the language range with the highest priority
        return $event->getLanguageRanges()->top();
    }
}
