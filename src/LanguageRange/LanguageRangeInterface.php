<?php

namespace MvLabsMultilanguage\LanguageRange;

/**
 * @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
 */
interface LanguageRangeInterface
{
    /**
     * The languages are specified using a two-letter code for a particular
     * language, using the ISO-639 standard.
     * For example, Spanish is "es", English is "en" and French is "fr".
     *
     * @return string
     */
    public function language();

    /**
     * The country is specified using a two letter code specified in the
     * ISO-3166 standard.
     *
     * @return string
     */
    public function country();

    /**
     * Returns the default locale for the language range, considering the
     * language and the country, if present
     */
    public function defaultLocale();

    /**
     * String representation of the language range
     *
     * @return string
     */
    public function __toString();
}
