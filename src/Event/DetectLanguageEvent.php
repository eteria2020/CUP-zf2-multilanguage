<?php

namespace MvLabsMultilanguage\Event;

use MvLabsMultilanguage\LanguageRange\LanguageRange;

use Zend\EventManager\Event;
use Zend\Stdlib\PriorityQueue;
use Zend\Http\Request;

class DetectLanguageEvent extends Event implements DetectLanguageEventInterface
{
    /**
     * @var PriorityQueue $languageRanges
     */
    private $languageRanges;

    /**
     * @var Request $request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->languageRanges = new PriorityQueue();
        $this->request = $request;
    }

    /**
     * @inheritdoc
     */
    public function getLanguageRanges()
    {
        return $this->languageRanges;
    }

    /**
     * @inheritdoc
     */
    public function setLanguageRanges(PriorityQueue $languageRanges)
    {
        $this->languageRanges = $languageRanges;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @inheritdoc
     */
    public function hasLanguageRange(LanguageRange $languageRange)
    {
        return $this->languageRanges->contains($languageRange);
    }

    /**
     * @inheritdoc
     */
    public function addLanguageRange(LanguageRange $languageRange)
    {
        $this->languageRanges->insert($languageRange);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeLanguageRange(LanguageRange $languageRange)
    {
        $this->languageRanges->remove($languageRange);
    }
}
