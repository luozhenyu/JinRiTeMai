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

}