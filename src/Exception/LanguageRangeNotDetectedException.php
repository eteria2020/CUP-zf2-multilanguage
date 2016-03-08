<?php

namespace MvLabsMultilanguage\Exception;

class LanguageRangeNotDetectedException extends \UnexpectedValueException
{
    protected $message = 'It was not possible to detect the language range from the provided request';
}
