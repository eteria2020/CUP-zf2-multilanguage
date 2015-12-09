<?php

namespace MvLabsMultilanguage\Service;

use MvLabsMultilanguage\Exception\LanguageRangeNotDetectedException;
use MvLabsMultilanguage\Detector\LanguageDetectorInterface;

use Zend\Http\Request;
use Zend\Mvc\I18n\Translator;
use Zend\EventManager\EventManagerInterface;

class LanguageService implements LanguageServiceInterface
{
    /**
     * @var Zend\Mvc\I18n\Translator $translator
     */
    private $translator;

    /**
     * @var LanguageDetectorInterface $languageDetector
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
    public function setLanguageFromRequest(Request $request)
    {
        try {
            // we ask the language detector to retrieve the correct language
            // range
            $languageRange = $this->languageDetector->detectLanguageRange($request);

            // we set the correct locale fot the Mvc Translator
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
