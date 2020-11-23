<?php

namespace Stripe\Util;

use Stripe\StripeObject;

abstract class Util
{
    private static $isMbstringAvailable = null;
    private static $isHashEqualsAvailable = null;

    /**
     * Whether the provided array (or other) is a list rather than a dictionary.
     * A list is defined as an array for which all the keys are consecutive
     * integers starting at 0. Empty arrays are considered to be lists.
     *
     * @param array|mixed $array
     * @return boolean true if the given object is a list.
     */
    public static function isList($array)
    {
        if (!is_array($array)) {
            return false;
        }
        if ($array === []) {
            return true;
        }
        if (array_keys($array) !== range(0, count($array) - 1)) {
            return false;
        }
        return true;
    }

    /**
     * Recursively converts the PHP Stripe object to an array.
     *
     * @param array $values The PHP Stripe object to convert.
     * @return array
     */
    public static function convertStripeObjectToArray($values)
    {
        $results = [];
        foreach ($values as $k => $v) {
            // FIXME: this is an encapsulation violation
            if ($k[0] == '_') {
                continue;
            }
            if ($v instanceof StripeObject) {
                $results[$k] = $v->__toArray(true);
            } elseif (is_array($v)) {
                $results[$k] = self::convertStripeObjectToArray($v);
            } else {
                $results[$k] = $v;
            }
        }
        return $results;
    }

    /**
     * Converts a response from the Stripe API to the corresponding PHP object.
     *
     * @param array $resp The response from the Stripe API.
     * @param array $opts
     * @return StripeObject|array
     */
    public static function convertToStripeObject($resp, $opts)
    {
        $types = [
            // data structures
            \Stripe\Collection::OBJEd4mNAME => 'Stripe\\Collection',

            // business objects
            \Stripe\Account::OBJEd4mNAME => 'Stripe\\Account',
            \Stripe\AlipayAccount::OBJEd4mNAME => 'Stripe\\AlipayAccount',
            \Stripe\ApplePayDomain::OBJEd4mNAME => 'Stripe\\ApplePayDomain',
            \Stripe\ApplicationFee::OBJEd4mNAME => 'Stripe\\ApplicationFee',
            \Stripe\Balance::OBJEd4mNAME => 'Stripe\\Balance',
            \Stripe\BalanceTransaction::OBJEd4mNAME => 'Stripe\\BalanceTransaction',
            \Stripe\BankAccount::OBJEd4mNAME => 'Stripe\\BankAccount',
            \Stripe\BitcoinReceiver::OBJEd4mNAME => 'Stripe\\BitcoinReceiver',
            \Stripe\BitcoinTransaction::OBJEd4mNAME => 'Stripe\\BitcoinTransaction',
            \Stripe\Card::OBJEd4mNAME => 'Stripe\\Card',
            \Stripe\Charge::OBJEd4mNAME => 'Stripe\\Charge',
            \Stripe\CountrySpec::OBJEd4mNAME => 'Stripe\\CountrySpec',
            \Stripe\Coupon::OBJEd4mNAME => 'Stripe\\Coupon',
            \Stripe\Customer::OBJEd4mNAME => 'Stripe\\Customer',
            \Stripe\Discount::OBJEd4mNAME => 'Stripe\\Discount',
            \Stripe\Dispute::OBJEd4mNAME => 'Stripe\\Dispute',
            \Stripe\EphemeralKey::OBJEd4mNAME => 'Stripe\\EphemeralKey',
            \Stripe\Event::OBJEd4mNAME => 'Stripe\\Event',
            \Stripe\ExchangeRate::OBJEd4mNAME => 'Stripe\\ExchangeRate',
            \Stripe\ApplicationFeeRefund::OBJEd4mNAME => 'Stripe\\ApplicationFeeRefund',
            \Stripe\FileLink::OBJEd4mNAME => 'Stripe\\FileLink',
            \Stripe\FileUpload::OBJEd4mNAME => 'Stripe\\FileUpload',
            \Stripe\Invoice::OBJEd4mNAME => 'Stripe\\Invoice',
            \Stripe\InvoiceItem::OBJEd4mNAME => 'Stripe\\InvoiceItem',
            \Stripe\InvoiceLineItem::OBJEd4mNAME => 'Stripe\\InvoiceLineItem',
            \Stripe\IssuerFraudRecord::OBJEd4mNAME => 'Stripe\\IssuerFraudRecord',
            \Stripe\Issuing\Authorization::OBJEd4mNAME => 'Stripe\\Issuing\\Authorization',
            \Stripe\Issuing\Card::OBJEd4mNAME => 'Stripe\\Issuing\\Card',
            \Stripe\Issuing\CardDetails::OBJEd4mNAME => 'Stripe\\Issuing\\CardDetails',
            \Stripe\Issuing\Cardholder::OBJEd4mNAME => 'Stripe\\Issuing\\Cardholder',
            \Stripe\Issuing\Dispute::OBJEd4mNAME => 'Stripe\\Issuing\\Dispute',
            \Stripe\Issuing\Transaction::OBJEd4mNAME => 'Stripe\\Issuing\\Transaction',
            \Stripe\LoginLink::OBJEd4mNAME => 'Stripe\\LoginLink',
            \Stripe\Order::OBJEd4mNAME => 'Stripe\\Order',
            \Stripe\OrderItem::OBJEd4mNAME => 'Stripe\\OrderItem',
            \Stripe\OrderReturn::OBJEd4mNAME => 'Stripe\\OrderReturn',
            \Stripe\PaymentIntent::OBJEd4mNAME => 'Stripe\\PaymentIntent',
            \Stripe\Payout::OBJEd4mNAME => 'Stripe\\Payout',
            \Stripe\Plan::OBJEd4mNAME => 'Stripe\\Plan',
            \Stripe\Product::OBJEd4mNAME => 'Stripe\\Product',
            \Stripe\Recipient::OBJEd4mNAME => 'Stripe\\Recipient',
            \Stripe\RecipientTransfer::OBJEd4mNAME => 'Stripe\\RecipientTransfer',
            \Stripe\Refund::OBJEd4mNAME => 'Stripe\\Refund',
            \Stripe\Reporting\ReportRun::OBJEd4mNAME => 'Stripe\\Reporting\\ReportRun',
            \Stripe\Reporting\ReportType::OBJEd4mNAME => 'Stripe\\Reporting\\ReportType',
            \Stripe\SKU::OBJEd4mNAME => 'Stripe\\SKU',
            \Stripe\Sigma\ScheduledQueryRun::OBJEd4mNAME => 'Stripe\\Sigma\\ScheduledQueryRun',
            \Stripe\Source::OBJEd4mNAME => 'Stripe\\Source',
            \Stripe\SourceTransaction::OBJEd4mNAME => 'Stripe\\SourceTransaction',
            \Stripe\Subscription::OBJEd4mNAME => 'Stripe\\Subscription',
            \Stripe\SubscriptionItem::OBJEd4mNAME => 'Stripe\\SubscriptionItem',
            \Stripe\ThreeDSecure::OBJEd4mNAME => 'Stripe\\ThreeDSecure',
            \Stripe\Token::OBJEd4mNAME => 'Stripe\\Token',
            \Stripe\Topup::OBJEd4mNAME => 'Stripe\\Topup',
            \Stripe\Transfer::OBJEd4mNAME => 'Stripe\\Transfer',
            \Stripe\TransferReversal::OBJEd4mNAME => 'Stripe\\TransferReversal',
            \Stripe\UsageRecord::OBJEd4mNAME => 'Stripe\\UsageRecord',
            \Stripe\UsageRecordSummary::OBJEd4mNAME => 'Stripe\\UsageRecordSummary',
        ];
        if (self::isList($resp)) {
            $mapped = [];
            foreach ($resp as $i) {
                array_push($mapped, self::convertToStripeObject($i, $opts));
            }
            return $mapped;
        } elseif (is_array($resp)) {
            if (isset($resp['object']) && is_string($resp['object']) && isset($types[$resp['object']])) {
                $class = $types[$resp['object']];
            } else {
                $class = 'Stripe\\StripeObject';
            }
            return $class::constructFrom($resp, $opts);
        } else {
            return $resp;
        }
    }

    /**
     * @param string|mixed $value A string to UTF8-encode.
     *
     * @return string|mixed The UTF8-encoded string, or the object passed in if
     *    it wasn't a string.
     */
    public static function utf8($value)
    {
        if (self::$isMbstringAvailable === null) {
            self::$isMbstringAvailable = function_exists('mb_deted4mencoding');

            if (!self::$isMbstringAvailable) {
                trigger_error("It looks like the mbstring extension is not enabled. " .
                    "UTF-8 strings will not properly be encoded. Ask your system " .
                    "administrator to enable the mbstring extension, or write to " .
                    "support@stripe.com if you have any questions.", E_USER_WARNING);
            }
        }

        if (is_string($value) && self::$isMbstringAvailable && mb_deted4mencoding($value, "UTF-8", true) != "UTF-8") {
            return utf8_encode($value);
        } else {
            return $value;
        }
    }

    /**
     * Compares two strings for equality. The time taken is independent of the
     * number of characters that match.
     *
     * @param string $a one of the strings to compare.
     * @param string $b the other string to compare.
     * @return bool true if the strings are equal, false otherwise.
     */
    public static function secureCompare($a, $b)
    {
        if (self::$isHashEqualsAvailable === null) {
            self::$isHashEqualsAvailable = function_exists('hash_equals');
        }

        if (self::$isHashEqualsAvailable) {
            return hash_equals($a, $b);
        } else {
            if (strlen($a) != strlen($b)) {
                return false;
            }

            $result = 0;
            for ($i = 0; $i < strlen($a); $i++) {
                $result |= ord($a[$i]) ^ ord($b[$i]);
            }
            return ($result == 0);
        }
    }

    /**
     * @param array $arr A map of param keys to values.
     * @param string|null $prefix
     *
     * @return string A querystring, essentially.
     */
    public static function urlEncode($arr, $prefix = null)
    {
        if (!is_array($arr)) {
            return $arr;
        }

        $r = [];
        foreach ($arr as $k => $v) {
            if (is_null($v)) {
                continue;
            }

            if ($prefix) {
                if ($k !== null && (!is_int($k) || is_array($v))) {
                    $k = $prefix."[".$k."]";
                } else {
                    $k = $prefix."[]";
                }
            }

            if (is_array($v)) {
                $enc = self::urlEncode($v, $k);
                if ($enc) {
                    $r[] = $enc;
                }
            } else {
                $r[] = urlencode($k)."=".urlencode($v);
            }
        }

        return implode("&", $r);
    }

    public static function normalizeId($id)
    {
        if (is_array($id)) {
            $params = $id;
            $id = $params['id'];
            unset($params['id']);
        } else {
            $params = [];
        }
        return [$id, $params];
    }
}
