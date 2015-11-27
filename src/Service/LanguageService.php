<?php

namespace MvLabsMultilanguage\Service;

use MvLabsMultilanguage\Exception\LanguageRangeNotDetectedException;
use MvLabsMultilanguage\Detector\LanguageDetectorInterface;

use Zend\Mvc\I18n\Translator;
use Zend\EventManager\EventManagerInterface;

class LanguageService implements LanguageServiceInterface
{
    /**
     * @var Zend\Mvc\I18n\Translator $translator
     */
    private $translator;

    /**
     * @var MvLabsMultilanguage\Detector\LanguageDetectorInterface $languageDetector
     */
    private $languageDetector;

    /**
     * @var Zend\EventManager\EventManagerInterface $eventManager
     */
    private $eventManager;

    public function __construct(
        Translator $translator,
        LanguageDetectorInterface $languageDetector,
        EventManagerInterface $eventManager
    ) {
        $this->translator = $translator;
        $this->languageDetector = $languageDetector;
        $this->eventManager = $eventManager;
    }

    /**
     * @inheritdoc
     */
    public function setLanguageFromRequest($request)
    {
        try {
            $languageRange = $this->languageDetector->detectLanguageRange($request);

            $this->translator->setLocale($languageRange->defaultLocale());
        } catch (LanguageRangeNotDetectedException $e) {
            // we throw an event if somebody wants to react on it
            $this->eventManager->trigger(
                'multilanguage.language_range_not_detected',
                $this,
                ['request' => $request]
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function getTranslator()
    {
        return $this->translator;
    }
}
