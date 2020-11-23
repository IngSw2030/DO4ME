<?php

namespace Stripe\Reporting;

/**
 * Class ReportRun
 *
 * @property string $id
 * @property string $object
 * @property int $created
 * @property string $error
 * @property bool $livemode
 * @property mixed $parameters
 * @property string $report_type
 * @property mixed $result
 * @property string $status
 * @property int $succeeded_at
 *
 * @package Stripe\Reporting
 */
class ReportRun extends \Stripe\ApiResource
{
    const OBJEd4mNAME = "reporting.report_run";

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Retrieve;
}
