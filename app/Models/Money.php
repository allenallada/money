<?php

namespace App\Models;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Money as MoneyClass;

class Money extends Model
{
    use HasFactory;

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
        return new MoneyClass($this->value, $this->currency);
    }
}
