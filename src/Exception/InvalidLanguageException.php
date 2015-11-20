<?php

namespace MvLabs\Multilanguage\Exception;

class InvalidLanguageException extends \UnexpectedValueException
{
    protected $message = 'The provided language is not valid';
}
