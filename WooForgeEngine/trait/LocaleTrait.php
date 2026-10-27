<?php
/**
 * Locale Trait
 *
 * Provides methods for retrieving the current WordPress locale.
 *
 * @package WooForgeEngine
 * @author Mahdi Davoodi
 */
trait LocaleTrait
{
    /**
     * Current WordPress locale.
     *
     * @var string
     */
    private string $locale = '';

    /**
     * Get the current WordPress locale.
     *
     * @return string The current locale, such as fa_IR or en_US.
     */
    protected function setLocale(): string
    {
        $this->locale = get_locale();

        return $this->locale;
    }
}