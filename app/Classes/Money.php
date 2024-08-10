<?php

namespace App\Classes;

use App\Enums\Currency;

class Money
{
    private float $value;

    private Currency $currency;

    /**
     * Constructor, EUR as default
     */
    public function __construct(float $value, Currency $currency = Currency::EUR)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * get all shareable details, expandable
     */
    public function getDetails(): array
    {
        return [
            'amount'   => $this->value,
            'currency' => $this->currency
        ];
    }

    /**
     * value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * symbol
     */
    public function getCurrencySymbol()
    {
        return $this->currency->symbol();
    }

    /**
     * get the formatted value with currency
     */
    public function getFormatted()
    {
        $symbol = $this->currency->symbol();
        $decimals = $this->currency->decimals();
        return $symbol . ' ' . number_format($this->value, $decimals);
    }

    /**
     * add the value of this money class to another class
     * returns a new Money class
     */
    public function add(Money $money): Money
    {
        $value = $this->value + $money->getValue();
        return new Money($value, $this->currency);
    }

    /**
     * subtract the value of this money class to another class
     * returns a new Money class
     */
    public function subtract(Money $money): Money
    {
        $value = $this->value - $money->getValue();
        return new Money($value, $this->currency);
    }

    /**
     * mutiply the value of this money class to another class
     * returns a new Money class
     */
    public function multiply(Money $money): Money
    {
        $value = $this->value * $money->getValue();
        return new Money($value, $this->currency);
    }

    /**
     * divide the value of this money class to another class
     * returns a new Money class
     */
    public function divide(Money $money): Money
    {
        if ($money->getValue() === 0) {
            throw new \InvalidArgumentException("Cannot divide by zero.");
        }
        $value = $this->value / $money->getValue();
        return new Money($value, $this->currency);
    }
}
