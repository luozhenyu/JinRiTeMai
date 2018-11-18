<?php

namespace Luozhenyu\JinRiTeMai\Order;


use Carbon\Carbon;
use Luozhenyu\JinRiTeMai\Kernel\BaseClient;
use Luozhenyu\JinRiTeMai\Order\Status\BaseStatus;

class Client extends BaseClient
{
    const ORDER_CREATE_TIME = 'create_time';
    const ORDER_UPDATE_TIME = 'update_time ';
    /**
     * @var string
     */
    protected $name = 'product';

    /**
     * @param BaseStatus|null $order_status
     * @param Carbon|null $start_time
     * @param Carbon|null $end_time
     * @param string $order_by
     * @param bool $is_desc
     * @param int $page
     * @param int $size
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function list(
        $order_status = null,
        $start_time = null,
        $end_time = null,
        string $order_by = self::ORDER_CREATE_TIME,
        bool $is_desc = false,
        int $page = 0,
        int $size = 10
    )
    {
        $query['order_by'] = $order_by;
        $query['is_desc'] = $is_desc;
        $query['page'] = $page;
        $query['size'] = $size;
        if (!is_null($order_status)) {
            $query['order_status'] = $order_status->getCode();
        }

        if (!is_null($start_time)) {
            $query['start_time'] = $start_time->toDateTimeString();
        }

        if (!is_null($end_time)) {
            $query['end_time'] = $end_time->toDateTimeString();
        }
        return $this->httpGet('order/list', $query);
    }

    /**
     * @param string $order_id
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function detail(string $order_id)
    {
        return $this->httpGet('order/detail', compact('order_id'));
    }

    /**
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function logisticsCompanyList()
    {
        return $this->httpGet('order/logisticsCompanyList');
    }

    /**
     * @param string $order_id
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function stockUp(string $order_id)
    {
        return $this->httpGet('order/stockUp', compact('order_id'));
    }

    /**
     * @param string $order_id
     * @param string $logistics_id
     * @param string $logistics_code
     * @param string|null $company
     * @param string|null $post_from
     * @param string|null $post_addr
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function logisticsAdd(
        string $order_id,
        string $logistics_id,
        string $logistics_code,
        $company = null,
        $post_from = null,
        $post_addr = null
    )
    {
        $query['order_id'] = $order_id;
        $query['logistics_id'] = $logistics_id;
        $query['logistics_code'] = $logistics_code;
        if (!is_null($company)) {
            $query['company'] = $company;
        }

        if (!is_null($post_from)) {
            $query['post_from'] = $post_from;
        }

        if (!is_null($post_addr)) {
            $query['post_addr'] = $post_addr;
        }
        return $this->httpGet('order/logisticsAdd', $query);
    }

    /**
     * @param string $order_id
     * @param string $logistics_id
     * @param string $logistics_code
     * @param string|null $company
     * @param string|null $post_from
     * @param string|null $post_addr
     * @return array
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException
     * @throws \Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException
     */
    public function logisticsEdit(
        string $order_id,
        string $logistics_id,
        string $logistics_code,
        $company = null,
        $post_from = null,
        $post_addr = null
    )
    {
        $query['order_id'] = $order_id;
        $query['logistics_id'] = $logistics_id;
        $query['logistics_code'] = $logistics_code;
        if (!is_null($company)) {
            $query['company'] = $company;
        }

        if (!is_null($post_from)) {
            $query['post_from'] = $post_from;
        }

        if (!is_null($post_addr)) {
            $query['post_addr'] = $post_addr;
        }
        return $this->httpGet('order/logisticsEdit', $query);
    }
}