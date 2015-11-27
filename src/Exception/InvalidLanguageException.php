<?php

namespace MvLabsMultilanguage\Exception;

class InvalidLanguageException extends \UnexpectedValueException
{
    protected $message = 'The provided language is not valid';
}
