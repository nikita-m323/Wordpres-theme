<?php

namespace App\Acf\Blocks;

use App\Acf\Acf;

class Blocks
{
    public function __construct()
    {
        add_action('init', [$this, 'register_acf_blocks']);
        add_filter('block_categories_all', [$this, 'add_custom_categories']);
    }

    /**
     * Creating a custom category for Gutenberg
     *
     * @param $categories
     * @return array
     */
    public function add_custom_categories($categories): array
    {
        return array_merge(
            [
                [
                    'slug' => 'custom-category',
                    'title' => esc_html__('Custom category', 'wordpress-theme')
                ]
            ],
            $categories
        );
    }

    /**
     * Registering Gutenberg blocks
     *
     * @return void
     */
    public function register_acf_blocks(): void
    {
        if (Acf::isAcfPluginActivated()) {
            register_block_type(get_template_directory(). '/assets/webpack-dist/gutenberg/unsplash-slider');
        }
    }

}