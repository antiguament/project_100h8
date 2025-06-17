<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array content()
 * @method static int count()
 * @method static float total()
 * @method static void add(int $id, string $name, float $price, int $quantity, string $image, int $stock)
 * @method static void update(int $id, int $quantity)
 * @method static void remove(int $id)
 * @method static void clear()
 */
class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
