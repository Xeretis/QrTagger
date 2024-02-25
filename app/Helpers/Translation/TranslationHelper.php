<?php

namespace App\Helpers\Translation;

use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\Exceptions\LargeTextException;
use Stichoza\GoogleTranslate\Exceptions\RateLimitException;
use Stichoza\GoogleTranslate\Exceptions\TranslationRequestException;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
    /**
     * @var string Default source language.
     */
    private static string $source = 'en';

    /**
     * @var string|null Default target language.
     */
    private static ?string $target = null;

    /**
     * Translate the given text from the source language to the target language.
     *
     * @param string $text The text to be translated.
     * @return string The translated text.
     */
    public static function translate(string $text): string
    {
        $translatedText = '';

        if (self::$target === null) {
            self::$target = app()->getLocale();
        }

        if (self::$source === self::$target) {
            return $text;
        }

        try {
            $translator = new GoogleTranslate();
            $translator->setSource(self::$source);
            $translator->setTarget(self::$target);

            $translatedText = $translator->translate($text);
        } catch (LargeTextException|RateLimitException|TranslationRequestException $ex) {
            Log::error('TranslateTextHelperException', [
                'message' => $ex->getMessage(),
            ]);
            return $text;
        }

        return $translatedText;
    }

    /**
     * Set the source language.
     *
     * @param string $source The source language code.
     * @return self This instance of the class.
     */
    public static function setSource(string $source): self
    {
        self::$source = $source;

        return new self();
    }

    /**
     * Set the target language.
     *
     * @param string $target The target language code.
     * @return self This instance of the class.
     */
    public static function setTarget(string $target): self
    {
        self::$target = $target;

        return new self();
    }
}
