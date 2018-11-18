<?php

namespace Luozhenyu\JinRiTeMai\Order\Status;


/**
 * Class OrderStockUp
 * @package Luozhenyu\JinRiTeMai\Order\Status
 */
class OrderStockUp extends BaseStatus
{
    /**
     * @var string
     */
    protected $code = 2;

    /**
     * @var string
     */
    protected $message = '备货中';

    /**
     * @var string
     */
    protected $note = '(用户已付款) 此状态商户才可执行发货操作 (货到付款的订单, 商家需要先确认订单才会进入此状态)';
}
