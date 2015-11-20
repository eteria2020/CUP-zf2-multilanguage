<?php

namespace MvLabs\Multilanguage\Detector;

use Zend\Http\Request;

interface LanguageDetectorInterface
{
    /**
     * retrieves the locale from the Http request
     * if the locale is not retrieved a LanguageRangeNotDetectedException is
     * thrown
     *
     * @param Zend\Http\Request
     * @return MvLabs\Multilanguage\LanguageRange\LanguageRangeInterface
     * @throws MvLabs\Multilanguage\Exception\LanguageRangeNotDetectedException
     */
    public function detectLanguageRange(Request $request);
}
