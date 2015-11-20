<?php

namespace MvLabs\Multilanguage\LanguageRange;

use MvLabs\Multilanguage\Exception\InvalidLanguageException;

class LanguageRange implements LanguageRangeInterface
{
    /**
     * @var string $language
     */
    private $language;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @param string $language
     * @param string $country
     * @throws InvalidLanguageException
     */
    public function __construct(
        $language,
        $country
    ) {
        if (strlen($language) !== 2) {
            throw new InvalidLanguageException();
        }

        $this->language = $language;
        $this->country = $country;
    }

    /**
     * static constructor from a string representation of the LanguageRange
     *
     * @param string $languageRange
     */
    public static function fromString($languageRange)
    {
        $language = substr($languageRange, 0, 2);
        $country = substr($languageRange, 3);

        return new static($language, $country);
    }

    /**
     * @inheritdoc
     */
    public function language()
    {
        return $this->language;
    }

    /**
     * inheritdoc
     */
    public function country()
    {
        return $this->country;
    }

    public function defaultLocale()
    {
        return strtolower($this->language) .
            ($this->country ? '_' . strtoupper($this->country) : '');
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return strtolower($this->language) .
            ($this->country ? '-' . strtolower($this->country) : '');
    }
}
