<?php

namespace App\Base;

final class Deregister
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'deregisterStyles']);
        add_action('wp_enqueue_scripts', [$this, 'deregisterScripts']);
        self::disableEmoji();
    }

    public function deregisterStyles()
    {
        wp_dequeue_style('dashicons');
    }

    public function deregisterScripts()
    {
        wp_dequeue_script('wp-emoji');
    }

    public function disableEmoji()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    }
}