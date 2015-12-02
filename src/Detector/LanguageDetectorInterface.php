<?php

namespace MvLabsMultilanguage\Detector;

use Zend\Http\Request;

interface LanguageDetectorInterface
{
    /**
     * retrieves the language range from the Http request
     * if the language range is not retrieved a
     * LanguageRangeNotDetectedException is thrown
     *
     * @param Request
     * @return MvLabsMultilanguage\LanguageRange\LanguageRangeInterface
     * @throws MvLabsMultilanguage\Exception\LanguageRangeNotDetectedException
     */
    public function detectLanguageRange(Request $request);
}
