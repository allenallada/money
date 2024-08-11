<?php

namespace App\Models;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Money as MoneyClass;

class Money extends Model
{
    /**
     * fillable columns
     */
    protected $fillable = [
        'value',
        'currency_value'
    ];

    /**
     * accessor for the equivalent Currency enum
     */
    public function getCurrencyAttribute()
    {
        return Currency::from($this->currency_value);
    }

    /**
     * Create a money class
     */
    public function createClass()
    {
        $class = new MoneyClass($this->value, $this->currency);
        $class->bind($this);
        return $class;
    }
}
