<?php

namespace Luozhenyu\JinRiTeMai\Product;


use Luozhenyu\JinRiTeMai\Kernel\BaseClient;

/**
 * Class Client
 * @package Luozhenyu\JinRiTeMai\Product
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $name = 'product';

    /**
     * @param int $cid
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function getGoodsCategory(int $cid = 0)
    {
        return $this->httpGet('product/getGoodsCategory', compact('cid'));
    }
}