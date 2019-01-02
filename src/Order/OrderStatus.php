<?php

namespace Luozhenyu\JinRiTeMai\Order;


/**
 * Class OrderStatus
 * @package Luozhenyu\JinRiTeMai\Order
 */
class OrderStatus
{
    const OrderStart = 0;
    const OrderToBeConfirm = 1;
    const OrderStockUp = 2;
    const OrderSent = 3;
    const OrderCancelled = 4;
    const OrderFinish = 5;

    /**
     * @var array
     */
    private static $annotations = [
        0 => '开始',
        1 => '待确认',
        2 => '备货中',
        3 => '已发货',
        4 => '已取消',
        5 => '已完成',
        6 => '(退货)退货中-用户申请',
        7 => '(退货)退货中-商家同意退货',
        8 => '(退货)退货中-客服仲裁',
        9 => '(退货)已关闭-退货失败',
        10 => '(退货)退货中-客服同意',
        11 => '(退货)退货中-用户填写完物流',
        12 => '(退货)已关闭-商户同意',
        13 => '(退货)退货中-再次客服仲裁',
        14 => '(退货)已关闭-客服同意',
        15 => '(退货)取消退货申请',
        16 => '(退款)申请退款中',
        17 => '(退款)商户同意退款',
        18 => '(退款)订单退款仲裁中',
        19 => '(退款)退款仲裁支持用户',
        20 => '(退款)退款仲裁支持商家',
        21 => '(退款)订单退款成功',
        22 => '(退款)售后退款成功',
        23 => '(退货)退货中-再次用户申请',
        24 => '(退货)已关闭-退货成功',
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
