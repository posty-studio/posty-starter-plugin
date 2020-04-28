<?php

namespace Posty_Starter_Plugin;

/**
 * Get a template part.
 *
 * @param string $name
 * @param array $args
 * @return string
 */
function get_template($name, $args = []) {
    set_query_var(POSTY_STARTER_PLUGIN_SLUG, $args);

    $path = POSTY_STARTER_PLUGIN_TEMPLATES_PATH . $name . '.php';

    if (!file_exists($path)) {
        return sprintf(
            /* translators: %s is the name of the template that's being included */
            __('Error: No template file found for the %s part.', 'posty-starter-plugin'),
            '<code>' . esc_html($name) . '</code>'
        );
    }

    ob_start();

    include($path);

    return ob_get_clean();
}

/**
 * Get a query variable.
 *
 * @param string $name
 * @param mixes $default
 * @return mixed
 */
function get_template_var($name, $default = null) {
    $query_var = get_query_var(POSTY_STARTER_PLUGIN_SLUG);

    if (!is_array($query_var) || !array_key_exists($name, $query_var)) {
        return $default;
    }

    return $query_var[$name];
}

/**
 * Conditionally join classes together.
 *
 * Based on https://github.com/cstro/classnames-php.
 *
 * @param string|array
 * @return string
 */
function classes() {
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
