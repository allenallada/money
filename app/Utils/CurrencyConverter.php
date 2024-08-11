<?php

namespace App\Utils;

use Exception;
use App\Enums\Currency;

class CurrencyConverter
{
    /**
     * exchange rates from specific currencies to EUR
     */
    public static function getConversionRates()
    {
        //left this as is to honor the resources provided
        //created as function if ever the conversion is from an API call
        return [
            4   => 1.08610000,
            11  => 1.45520000,
            25  => 9.50800000,
            26  => 5.15830000,
            28  => 1.95580000,
            32  => 1.36750000,
            36  => 6.91150000,
            39  => 1.58490000,
            41  => 7.54900000,
            44  => 24.47900000,
            46  => 7.43720000,
            66  => 8.51340000,
            67  => 375.66000000,
            68  => 139.60000000,
            69  => 82.38900000,
            70  => 15601.96000000,
            73  => 3.50100000,
            75  => 134.87000000,
            87  => 1.01550000,
            93  => 4.58500000,
            98  => 21.87290000,
            116 => 55.99000000,
            117 => 4.64370000,
            119 => 4.94250000,
            129 => 1.48010000,
            133 => 15.99680000,
            134 => 0.83355000,
            135 => 1333.12000000,
            141 => 10.27680000,
            146 => 36.48800000,
            150 => 16.02370000,
        ];
    }

    /**
     * convert a value from a currency to another
     */
    public static function convert(float $value, Currency $from, Currency $to): float
    {
        $euroValue = self::getEuroValue($value, $from);

        return self::convertFromEuro($euroValue, $to);
    }

    /**
     * convert the value to Euro
     */
    public static function getEuroValue(float $value, Currency $currency): float
    {
        if ($currency == Currency::EUR) {
            return $value;
        }

        return $value * self::getConversionRate($currency);
    }

    /**
     * convert from Euro value
     */
    public static function convertFromEuro(float $value, Currency $currency): float
    {
        if ($currency == Currency::EUR) {
            return $value;
        }

        return $value / self::getConversionRate($currency);
    }

    /**
     * get the conversion rate
     * throws an Exception if conversion rate is not available
     */
    public static function getConversionRate($currency): float
    {
        $rate = data_get(self::getConversionRates(), $currency->value, null);

        if (!isset($rate)) {
            throw new Exception("No available coversion rates is available for this currency");
        }

        return $rate;
    }
}
