<?php
namespace TurgunboyevUz\SPDO\Core;

class Translations{
    public static $items = [];
    public static $locale = '';

    public static function load($folder){
        $files = glob($folder."/language/*.php");

        foreach ($files as $filename) {
            $file = str_replace('.php', '', $filename);
            $ex = explode('/', $file);

            $config_name = end($ex);

            self::$items[$config_name] = require $filename;
        }
    }

    public static function get($key, $value){
        $items = self::$items;
        $key = explode('.', self::$locale.'.'.$key);

        foreach($key as $segment){
            if (!is_array($items) || !array_key_exists($segment, $items)) {
                return $value;
            }
    
            $items = $items[$segment];
        }

        return $items;
    }

    public static function locale($locale){
        if(!array_key_exists($locale, self::$items)){
            return false;
        }
        
        return self::$locale = $locale;
    }
}
?>