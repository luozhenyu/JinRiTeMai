<?php

namespace Luozhenyu\JinRiTeMai;

use Luozhenyu\JinRiTeMai\Kernel\ServiceContainer;

/**
 * Class Application
 * @package Luozhenyu\JinRiTeMai
 *
 *
 * @property \Luozhenyu\JinRiTeMai\Product\Client $product
 * @property \Luozhenyu\JinRiTeMai\Order\Client $order
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Product\ServiceProvider::class,
        Order\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'app' => [
            'version' => '1',
        ],
        'request' => [
            'timeout' => 30.0,
            'base_uri' => 'https://openapi.jinritemai.com',
        ],
    ];

    /**
     * @param string $appKey
     * @param string $appSecret
     * @param array $config
     * @return Application
     * @throws Kernel\Exception\JinRiTeMaiException
     */
    public static function make(string $appKey, string $appSecret, array $config = [])
    {
        return new static($appKey, $appSecret, $config);
    }
}