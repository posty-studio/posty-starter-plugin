<?php

namespace Posty_Starter_Plugin;

class Blocks {
    public $blocks = [
        'latest-events',
    ];

    public function __construct() {
        add_action('init', [$this, 'register']);
    }

    public function register() {
        foreach ($this->blocks as $block) {
            register_block_type(POSTY_STARTER_PLUGIN_SLUG . '/' . $block, [
                'render_callback' => function ($attributes, $content) use ($block) {
                    return call_user_func_array([$this, 'render'], [$attributes, $content, $block]);
                }
            ]);
        }
    }

    /**
     * Render a server-side rendered block.
     *
     * @param array $attributes Block attributes.
     * @param string $content Optional InnerBlocks content.
     * @param string $block Block name.
     * @return string
     */
    public function render($attributes, $content, $block) {
        return get_template('blocks/' . $block, [
            'attributes' => $attributes,
            'content' => $content,
            'class' => classes([
                "wp-block-posty-starter-plugin-{$block}",
                $attributes['className'] ?? ''
            ])
        ]);
    }
}
