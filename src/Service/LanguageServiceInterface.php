<?php

namespace MvLabs\Multilanguage\Service;

interface LanguageServiceInterface
{
    /**
     * select the appropriate locale to be used according to the received
     * request and sets it in the Mvc translator
     *
     * @param Zend\Http\Request
     */
    public function setLanguageFromRequest($request);

    /**
     * returns the used instance of the Mvc translator
     *
     * @return Zend\Mvc\I18n\Translator
     */
    public function getTranslator();
}
