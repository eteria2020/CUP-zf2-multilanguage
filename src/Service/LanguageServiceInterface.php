<?php

namespace MvLabsMultilanguage\Service;

use Zend\Http\Request;

/*
 * This service is the starting point of the module.
 * It interacts with the Mvc Translator the set the correct language to be used
 * in the application
 */
interface LanguageServiceInterface
{
    /**
     * select the appropriate locale to be used according to the received
     * request and sets it in the Mvc Translator
     *
     * @param Zend\Http\Request
     */
    public function setLanguageFromRequest(Request $request);

    /**
     * returns the used instance of the Mvc Translator
     *
     * @return Zend\Mvc\I18n\Translator
     */
    public function getTranslator();
}
