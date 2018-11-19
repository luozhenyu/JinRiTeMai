<?php

namespace Luozhenyu\JinRiTeMai\Product;


use Luozhenyu\JinRiTeMai\Kernel\BaseClient;

/**
 * Class Client
 * @package Luozhenyu\JinRiTeMai\Product
 */
class Client extends BaseClient
{
    const PRODUCT_PUT_ON = 0;
    const PRODUCT_PUT_OFF = 1;

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

    /**
     * @param int $page
     * @param int $size
     * @param int|null $status
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function list(
        int $page = 0,
        int $size = 10,
        $status = null
    )
    {
        $query['page'] = $page;
        $query['size'] = $size;
        if (!is_null($status)) {
            $query['status'] = $status;
        }

        return $this->httpGet('product/list', $query);
    }

    /**
     * @param string|null $product_id
     * @param string|null $out_product_id
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function detail($product_id = null, $out_product_id = null)
    {
        $query = [];

        if (!is_null($product_id)) {
            $query['product_id'] = $product_id;
        }

        if (!is_null($out_product_id)) {
            $query['ut_product_id'] = $out_product_id;
        }

        return $this->httpGet('product/detail', $query);
    }
}