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
        return $event->getLanguageRanges()->top();
    }
}
