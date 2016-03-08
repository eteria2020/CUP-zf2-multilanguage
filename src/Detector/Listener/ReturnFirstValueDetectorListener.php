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
        $languageRangesQueue = $event->getLanguageRanges();

        // if the queue is empty we just pass it on
        if ($languageRangesQueue->isEmpty()) {
            return $languageRangesQueue;
        }

        // just return the language range with the highest priority
        return $event->getLanguageRanges()->top();
    }
}
