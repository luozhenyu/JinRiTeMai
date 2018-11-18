<?php

namespace Luozhenyu\JinRiTeMai\Order\Status;


class OrderToBeConfirm extends BaseStatus
{
    /**
     * @var string
     */
    protected $code = 1;

    /**
     * @var string
     */
    protected $message = '待确认';

    /**
     * @var string
     */
    protected $note = '(用户下单未付款 或者 货到付款订单商家未确认)';
}
