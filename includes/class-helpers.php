<?php

namespace Posty_Starter_Plugin;

class Helpers {
    /**
     * Conditionally join classes together.
     *
     * Based on https://github.com/cstro/classnames-php.
     *
     * @param string|array
     * @return string
     */
    public static function classnames() {
        $args = func_get_args();
        $data = array_reduce($args, function ($result, $arg) {
            if (is_array($arg)) {
                return array_merge($result, $arg);
            }

            $result[] = $arg;

            return $result;
        }, []);

        $classes = array_map(function ($key, $value) {
            $condition = is_int($key) ? null : $value;
            $return    = is_int($key) ? $value : $key;

            $is_stringable_type   = !is_array($return) && !is_object($return);
            $is_stringable_object = is_object($return) && method_exists($return, '__toString');

            if (!$is_stringable_type && !$is_stringable_object) {
                return null;
            }

            if ($condition === null) {
                return $return;
            }

            return $condition ? $return : null;
        }, array_keys($data), array_values($data));

        return implode(' ', array_filter($classes));
    }
}
