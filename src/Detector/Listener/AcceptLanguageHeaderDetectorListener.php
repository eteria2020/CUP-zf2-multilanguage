<?php

namespace MvLabsMultilanguage\Detector\Listener;

use MvLabsMultilanguage\LanguageRange\LanguageRange;
use MvLabsMultilanguage\Event\DetectLanguageEventInterface;

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

        // if the request doesn't have an Accept-Language header, we don't
        // modify the language ranges of the event
        if (!$headers->has('Accept-Language')) {
            return $event->getLanguageRanges();
        }

        $languageRangesArray = $headers->get('Accept-Language')->getPrioritized();

        // we cycle throush the retrieved language ranges, ordered by priority
        foreach ($languageRangesArray as $languageRange) {
            // and we add them to the event
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

        // if they are already present we first remove them to avoid duplicates
        if ($event->hasLanguageRange($languageRange)) {
            $event->removeLanguageRange($languageRange);
        }

        $event->addLanguageRange($languageRange, $priority);
    }
}
