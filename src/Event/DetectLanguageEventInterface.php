<?php

namespace MvLabsMultilanguage\Event;

use MvLabsMultilanguage\LanguageRange\LanguageRange;

use Zend\EventManager\EventInterface;
use Zend\Stdlib\PriorityQueue;
use Zend\Http\Request;

/**
 * extends the EventInterface to be able to manage a PriorityQueue of
 * LanguageRanges
 */
interface DetectLanguageEventInterface extends EventInterface
{
    /**
     * @return Request
     */
    public function getRequest();

    /**
     * @return PriorityQueue
     */
    public function getLanguageRanges();

    /**
     * @param PriorityQueue
     * @return self
     */
    public function setLanguageRanges(PriorityQueue $languageRanges);

    /**
     * @param LanguageRange
     * @return bool
     */
    public function hasLanguageRange(LanguageRange $languageRange);

    /**
     * @param LanguageRange
     * @return self
     */
    public function addLanguageRange(LanguageRange $languageRange);

    /**
     * @param LanguageRange
     * @return self
     */
    public function removeLanguageRange(LanguageRange $languageRange);
}
