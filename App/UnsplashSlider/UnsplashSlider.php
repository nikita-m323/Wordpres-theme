<?php

namespace App\UnsplashSlider;

use App\Acf\Acf;
use Unsplash\HttpClient;
use Unsplash\Search;
use Unsplash\PageResult;
use Unsplash\Exception;

class UnsplashSlider
{
    /**
     * Gets an array of images from the WP cache or from Unsplash
     *
     * @param string $search
     * @param int $per_page
     * @param string $orientation
     * @return array
     */
    public static function get_images(string $search, int $per_page, string $orientation)
    {
        $key = sanitize_title("unsplash $search $per_page $orientation");

        $transient = get_transient($key);

        if ($transient) {
            return $transient;
        }

        $unsplash_search = self::unsplash_search($search, $per_page, $orientation);

        if ($unsplash_search) {
            set_transient($key, $unsplash_search, DAY_IN_SECONDS );
            return $unsplash_search;
        }

        return self::unsplash_search($search, $per_page, $orientation);
    }

    /**
     * Search for an image using specified parameters on Unsplash
     *
     * @param string $search
     * @param int $per_page
     * @param string $orientation
     * @return array
     */
    public static function unsplash_search(string $search, int $per_page, string $orientation): array
    {

        if (!Acf::isAcfPluginActivated()) return [];

        $unsplash_options = get_field('unsplash', 'option');

        $applicationId = (is_array($unsplash_options) && array_key_exists('applicationid', $unsplash_options) && $unsplash_options['applicationid']) ? $unsplash_options['applicationid'] : '';
        $secret = (is_array($unsplash_options) && array_key_exists('secret', $unsplash_options) && $unsplash_options['secret']) ? $unsplash_options['secret'] : '';

        try {
            HttpClient::init([
                'applicationId' => $applicationId,
                'secret' => $secret,
                'utmSource' => 'WordpressBlock'
            ]);

            $page = 1;
            $responce = Search::photos($search, $page, $per_page, $orientation);

            if ($responce instanceof PageResult) {

                $items = $responce->getResults();

                if (is_array($items)) {
                    $result = [];

                    foreach ($items as $item) {
                        $img = [];

                        if (array_key_exists('alt_description', $item)) {
                            $img['alt'] = $item['alt_description'];
                        }

                        if (array_key_exists('urls', $item) && is_array($item['urls']) && array_key_exists('full', $item['urls'])) {
                            $img['url'] = $item['urls']['full'];
                        }

                        $result[] = $img;
                    }

                    return $result;
                }

                return [];
            }

            return [];
        } catch (Exception $e) {
            return [];
        }
    }
}