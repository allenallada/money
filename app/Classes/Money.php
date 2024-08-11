<?php

namespace App\Classes;

use App\Enums\Currency;

class Money
{
    private float $value;

    private Currency $currency;

    private int $discount = 0; //default value is zero

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
    public function getValue(): float
    {
        if ($this->discount == 0) {
            return $this->value;
        }

        return $this->value - $this->getDiscountValue();
    }

    /**
     * original value
     */
    public function getOriginalValue(): float
    {
        return $this->value;
    }

    /**
     * symbol
     */
    public function getCurrencySymbol(): ?string
    {
        return $this->currency->symbol();
    }

    /**
     * discount
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * the computed discount value
     */
    public function getDiscountValue(): float
    {
        return ($this->discount / 100) * $this->value;;
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

    public function setDiscount(int $discount): Money
    {
        if ($discount > 100 || $discount < 0) {
            throw new \InvalidArgumentException("Discount must be from 0 to 100");
        }
        $this->discount = $discount;
        return $this;
    }
}
