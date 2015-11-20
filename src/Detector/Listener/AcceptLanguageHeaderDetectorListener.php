<?php

namespace MvLabs\Multilanguage\Detector\Listener;

use MvLabs\Multilanguage\LanguageRange\LanguageRange;
use MvLabs\Multilanguage\Event\DetectLanguageEventInterface;

use Zend\Http\Header\Accept\FieldValuePart\LanguageFieldValuePart;

/**
 * uses the AcceptLanguage header of the HTTP request to determine a list of
 * LanguageRanges
 */
class AcceptLanguageHeaderDetectorListener implements LanguageDetectorListenerInterface
{
    /**
     * @inheritdoc
     */
    public function detectLanguage(DetectLanguageEventInterface $event)
    {
        $request = $event->getRequest();
        $headers = $request->getHeaders();

        if (!$headers->has('Accept-Language')) {
            return $event->getLanguageRanges();
        }

        $languageRangesArray = $headers->get('Accept-Language')->getPrioritized();

        foreach ($languageRangesArray as $languageRange) {
            $this->addLanguageRange($event, $languageRange);
        }

        return $event->getLanguageRanges();
    }

    /**
     * @param array $languageRange with keys priority and
     */
    private function addLanguageRange(
        DetectLanguageEventInterface $event,
        LanguageFieldValuePart $languageRange
    ) {
        $priority = $languageRange->getPriority() * 100;
        $languageRange = LanguageRange::fromString($languageRange->getLanguage());

        if ($event->hasLanguageRange($languageRange)) {
            $event->removeLanguageRange($languageRange);
        }

        $event->addLanguageRange($languageRange, $priority);
    }
}
