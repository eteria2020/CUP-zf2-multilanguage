<?php

namespace MvLabs\Multilanguage\Event;

use Zend\Http\Request;

class DetectLanguageEventFactory
{
    public static function createEvent(Request $request)
    {
        return new DetectLanguageEvent($request);
    }
}
