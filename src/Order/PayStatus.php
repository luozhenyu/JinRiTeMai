<?php

namespace Luozhenyu\JinRiTeMai\Order;


/**
 * Class PayStatus
 * @package Luozhenyu\JinRiTeMai\Order
 */
class PayStatus
{
    const CashOnDelivery = 0;
    const WeChatPay = 1;
    const AliPay = 2;

    /**
     * @var array
     */
    private static $annotations = [
        0 => '货到付款',
        1 => '微信',
        2 => '支付宝',
    ];

    /**
     * @param int $code
     * @return string
     */
    public static function getMessage(int $code): string
    {
        return static::$annotations[$code] ?? '';
    }
}
