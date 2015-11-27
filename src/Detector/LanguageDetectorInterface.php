<?php

namespace MvLabsMultilanguage\Detector;

use Zend\Http\Request;

interface LanguageDetectorInterface
{
    /**
     * retrieves the locale from the Http request
     * if the locale is not retrieved a LanguageRangeNotDetectedException is
     * thrown
     *
     * @param Zend\Http\Request
     * @return MvLabsMultilanguage\LanguageRange\LanguageRangeInterface
     * @throws MvLabsMultilanguage\Exception\LanguageRangeNotDetectedException
     */
    public function detectLanguageRange(Request $request);
}
