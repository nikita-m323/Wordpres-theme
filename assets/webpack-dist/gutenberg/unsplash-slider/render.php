<?php

use Timber\Timber;
use App\UnsplashSlider\UnsplashSlider;

$context['wrapper_attr'] = get_block_wrapper_attributes(
    [
        'id' => (array_key_exists('anchor', $block) && $block['anchor']) ? $block['anchor'] : null, // Allow for id to pass-through
        'class' => 'unsplash-slider',
        'style' => '',
    ]
);
$fields = get_fields();
$context['fields'] = $fields;

if (array_key_exists('query', $fields) && $fields['query']['keyword'] && $fields['query']['count'] && $fields['query']['orientation']) {
    $images = UnsplashSlider::get_images($fields['query']['keyword'], intval($fields['query']['count']), $fields['query']['orientation']);
    $context['images'] = $images;
}

Timber::render('gutenberg/unsplash-slider.twig', $context);