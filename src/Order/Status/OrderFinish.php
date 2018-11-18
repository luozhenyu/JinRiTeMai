<?php

namespace Luozhenyu\JinRiTeMai\Order\Status;


/**
 * Class OrderFinish
 * @package Luozhenyu\JinRiTeMai\Order\Status
 */
class OrderFinish extends BaseStatus
{
    /**
     * @var string
     */
    protected $code = 5;

    /**
     * @var string
     */
    protected $message = '已完成';

    /**
     * @var string
     */
    protected $note = <<<TEXT
在线支付订单: 商家发货后, 用户收货、拒收或者15天无物流
货到付款订单: 用户确认收货
TEXT;
}
