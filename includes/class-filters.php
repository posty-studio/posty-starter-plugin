<?php

namespace Posty_Starter_Plugin;

class Filters {
    public function __construct() {
        add_filter('wp_kses_allowed_html', [$this, 'kses_allow_svg']);
    }

    /**
     * Allow SVG elements in posts.
     *
     * @param array $allowedposttags
     * @param string $context
     * @return array
     */
    public function kses_allow_svg($allowedposttags) {
        $svg_child_attributes = [
            'cx' => true,
            'cy' => true,
            'r' => true,
            'd' => true,
            'fill' => true,
            'fill-rule' => true,
            'transform' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
        ];

        return array_merge($allowedposttags, [
            'svg' => [
                'class' => true,
                'aria-hidden' => true,
                'aria-labelledby' => true,
                'role' => true,
                'xmlns' => true,
                'width' => true,
                'height' => true,
                'viewbox' => true,
            ],
            'title' => ['title' => true],
            'g' => $svg_child_attributes,
            'path' => $svg_child_attributes,
            'circle' => $svg_child_attributes,
        ]);
    }
}
