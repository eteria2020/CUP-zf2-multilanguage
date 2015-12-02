<?php

namespace MvLabsMultilanguage\Detector\Listener;

use MvLabsMultilanguage\Languagerange\LanguageRange;
use MvLabsMultilanguage\Event\DetectLanguageEventInterface;

use Zend\Stdlib\PriorityQueue;

/**
 * Filters the LanguageRanges leaving just the ones present in the array passed
 * in the constructor
 */
class FilterByConfigurationDetectorListener implements LanguageDetectorListenerInterface
{
    /**
     * @var array $allowedLanguageRanges
     */
    private $allowedLanguageRanges;

    /**
     * @param array $allowedLanguageRanges
     */
    public function __construct(array $allowedLanguageRanges)
    {
        $this->allowedLanguageRanges = $allowedLanguageRanges;
    }

    /**
     * @inheritdoc
     */
    public function detectLanguage(DetectLanguageEventInterface $event)
    {
        // retrieve event language ranges with their priority
        $languageRanges = $event->getLanguageRanges();
        $languageRangesWithPriority = $languageRanges->toArray(PriorityQueue::EXTR_BOTH);

        // we instantiate a new priority queue to keep track of the filtered
        // language ranges
        $filteredLanguageRanges = new PriorityQueue();

        foreach ($languageRangesWithPriority as $languageRangeWithPriority) {
            $languageRange = $languageRangeWithPriority['data'];
            $priority = $languageRangeWithPriority['priority'];

            // we retrieve the allowed language ranges for the LanguageRange
            $priorityAllowedLanguageRanges = $this->priorityAllowedLanguageRanges($languageRange);

            foreach ($priorityAllowedLanguageRanges as $priorityAllowedLanguageRange) {
                $allowedLanguageRange = LanguageRange::fromString($priorityAllowedLanguageRange);

                // we populate the new PriorityQueue with the filtered
                // language ranges
                $filteredLanguageRanges->insert($allowedLanguageRange, $priority);
            }
        }

        $event->setLanguageRanges($filteredLanguageRanges);

        return $event->getLanguageRanges();
    }

    /**
     * Retrieves the language tags among the ones provided in the
     * $languageRanges class parameter that belongs to the provided
     * $languageRange
     *
     * @param LangaugeRange $languageRange
     * @return LanguageRange[]
     */
    private function priorityAllowedLanguageRanges(LanguageRange $languageRange)
    {
        return array_filter(
            $this->allowedLanguageRanges,
            function ($allowedLanguageRange) use ($languageRange) {
                $allowedLanguageRange = LanguageRange::fromString($allowedLanguageRange);
                // an $annowedLanguageRange belongs to a LanguageRange if they
                // have the same language and, if the $languageRange has a
                // country, if they have the same country
                $return = $allowedLanguageRange->language() === $languageRange->language();

                if (!empty($languageRange->country())) {
                    $return = $return &&
                        $allowedLanguageRange->country() === $languageRange->country();
                }

                return $return;
            }
        );
    }
}
