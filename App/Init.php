<?php
/**
 * Init theme class
 */

namespace App;

final class Init
{
    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */
    private static function get_services(): array
    {
        // Array of classes needed to init
        return array(
            Base\Enqueue::class,
            Base\Deregister::class,
            Base\Options::class,
            Acf\Blocks\Blocks::class,
        );
    }

    /**
     * Loop through the classes, initialize them
     */
    public static function register_services(): void
    {
        // Init theme classes
        foreach (self::get_services() as $class) {
            new $class;
        }
    }
}