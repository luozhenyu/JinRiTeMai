<?php

namespace Luozhenyu\JinRiTeMai\Product;


/**
 * Class ProductStatus
 * @package Luozhenyu\JinRiTeMai\Order
 */
class ProductStatus
{
    const PutOn = 0;
    const PutOff = 1;

    /**
     * @var array
     */
    private static $annotations = [
        0 => '上架',
        1 => '下架',
    ];

    /**
     * @param int $code
     * @return string
     */
    public static function getMessage(int $code): string
    {
        return static::$annotations[$code] ?? '';
    }
}
