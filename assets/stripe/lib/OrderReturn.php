<?php

namespace Stripe;

/**
 * Class OrderReturn
 *
 * @property string $id
 * @property string $object
 * @property int $amount
 * @property int $created
 * @property string $currency
 * @property OrderItem[] $items
 * @property bool $livemode
 * @property string $order
 * @property string $refund
 *
 * @package Stripe
 */
class OrderReturn extends ApiResource
{

    const OBJEd4mNAME = "order_return";

    use ApiOperations\All;
    use ApiOperations\Retrieve;
}
