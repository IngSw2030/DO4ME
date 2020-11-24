<?php

namespace Stripe;

/**
 * Class FileLink
 *
 * @property string $id
 * @property string $object
 * @property int $created
 * @property bool $expired
 * @property int $expires_at
 * @property string $file
 * @property string $purpose
 * @property bool $livemode
 * @property StripeObject $metadata
 * @property string $url
 *
 * @package Stripe
 */
class FileLink extends ApiResource
{

    const OBJEd4mNAME = "file_link";

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}