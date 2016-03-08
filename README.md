MV MULTILANGUAGE
==================

Introduction
------------
This is a Zend Framework 2 module that provides some functionalities to help with the management of a multilanguage website.

Installation using composer
---------------------------

The easiest way to use this module is to add it to [Composer](https://getcomposer.org/). If you don't have it already installed, then please install as per the [documentation](https://getcomposer.org/doc/00-intro.md).

    composer require mvlabs/zf2-multilanguage

Configuration
-------------

In the `config` folder you can find a `multilanguage.global.php.dist` file. Copy it to your `config/autoload` directory, rename it to `multilanguage.global.php` and adapt it to your needs.

In the configuration file you will find two things:

- `allowed_languages` is used to define the languages that are available for the application

- `listeners` allows to determine the strategy used to determine the correct language range to be used for the application. Every listener performs a step of the strategy.

For the module to work, you will also need to define the `translator` key in the configuration, as it usually defined for the `I18n` tools.

Components
----------

The package is build around the concept of *language range*. A language range is just a couple of a language an of an optional country. Examples of language ranges could be `en`, `en-US`, `en-GB`. If you need a more precise definition and description you could refer to [the w3 definition](http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html).

The starting point of the module is the `LanguageService` class. It is the one that retrieves the correct language to be used in the application and sets it in the Mvc Translator that will be used later to translate the routes, the views and the validation error messages.

The actual work of retrieving the correct language range will be performed by the `LanguageDetector` class. In the default implementation we use the event manager to delegate the hard work to a series of listeners. A `DetetLanguageEvent` is used to keep track of the state of the language range retrieving.

In this first basic implementation there are three listeners:

- `AcceptLanguageHeaderDetectorListener`: retrieves the languages ranges specified in the `Accept-Language` header of the HTTP request;

- `FilterByConfigurationDetectorListener`: filters the language ranges already present in the `DetectLanguageEvent` using the ones specified in the configuration;

- `ReturnFirstValueDetectorListener`: returns the language range present in the `DetectLanguageEvent` with the highest priority.

Extend and adapt
----------------

The package is written using interfaces whereever it was possible, so you could easily change or replace any piece of the implementation.

The part where you probably will have to extend the provided implementation is by writing some listeners that work accordingly to the language definition strategy of your application and modifying the configuration to make use of them.

Contribute
----------

I'll be glad to integrate new listeners, so we could implement easily various language definition strategies.

The package follows [PSR-1] and [PSR-2] as coding standards. Please respect them.