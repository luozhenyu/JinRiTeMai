<?php

namespace Luozhenyu\JinRiTeMai\Order\Status;


class OrderSent extends BaseStatus
{
    /**
     * @var string
     */
    protected $code = 4;

    /**
     * @var string
     */
    protected $message = '已取消';

    /**
     * @var string
     */
    protected $note = <<<TEXT
1.用户未支付并取消订单
2.或超时未支付后系统自动取消订单
3.或货到付款订单用户拒收
TEXT;
}
