<?php

namespace Posty_Starter_Plugin;

class Template {
    /**
     * Get a template part.
     *
     * @param string $name
     * @param array $args
     * @return string
     */
    public static function get($name, $args = []) {
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
    public static function var($name, $default = null) {
        $query_var = get_query_var(POSTY_STARTER_PLUGIN_SLUG);

        if (!is_array($query_var) || !array_key_exists($name, $query_var)) {
            return $default;
        }

        return $query_var[$name];
    }
}
