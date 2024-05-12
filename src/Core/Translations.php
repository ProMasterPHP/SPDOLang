<?php
namespace TurgunboyevUz\SPDO\Core;

class Translations {
    private static $items = [];
    private static $currentLocale;

    public static function load($folder) {
        $files = glob($folder . '/languages/*.php');

        foreach ($files as $filename) {
            $locale = basename($filename, '.php');
            self::$items[$locale] = require $filename;
        }
    }

    public static function get($key, array $vars = [], $default = null) {
        $locale = self::$currentLocale ?? array_keys(self::$items)[0];
        $translation = self::$items[$locale] ?? [];

        $segments = explode('.', $key);

        foreach ($segments as $segment) {
            if (!is_array($translation) || !array_key_exists($segment, $translation)) {
                return self::replaceVars($default, $vars);
            }

            $translation = $translation[$segment];
        }

        return self::replaceVars($translation, $vars);
    }

    public static function locale($locale) {
        if (!array_key_exists($locale, self::$items)) {
            return false;
        }

        self::$currentLocale = $locale;
        return true;
    }

    private static function replaceVars(string $text, array $vars) {
        foreach ($vars as $key => $value) {
            $text = str_replace('{' . $key . '}', $value, $text);
        }

        return $text;
    }
}
