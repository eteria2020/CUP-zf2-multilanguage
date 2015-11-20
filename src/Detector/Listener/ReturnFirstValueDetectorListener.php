<?php

namespace MvLabs\Multilanguage\Detector\Listener;

use MvLabs\Multilanguage\Event\DetectLanguageEventInterface;

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
