<?php

namespace Luozhenyu\JinRiTeMai\Product;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['product'] = function ($app) {
            return new Client($app);
        };
    }
}