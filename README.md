
# Money Class

This README provides an overview and usage examples for the `Money` class.

# Usage/Import

```php
use App\Classes\Money;

$money = new Money(100, Currency::EUR);
$money->getValue();
```

## Constructor

### `__construct(float $value, Currency $currency = Currency::EUR)`

Creates a new `Money` object.

**Parameters:**
- `$value` (float): The monetary value.
- `$currency` (Currency): The currency of the value. Defaults to EUR.

**Example:**
```php
$money = new Money(100, Currency::EUR);
```

## Public Methods

### `getDetails(): array`

Returns the details of the money object, including amount and currency.

**Example:**
```php
$details = $money->getDetails();
// ['amount' => 100.0, 'currency' => Currency::EUR]
```

### `getValue(): float`

Returns the current value, considering any applied discount.

**Example:**
```php
$money = new Money(100, Currency::EUR);
$value = $money->getValue();
// 100.0

$money = new Money(100, Currency::EUR);
$money->setDiscount(10);
$value = $money->getValue();
// 90.0
```

### `getOriginalValue(): float`

Returns the original value without any discount.

**Example:**
```php
$originalValue = $money->getOriginalValue();
// 100.0
```

### `getCurrency(): Currency`

Returns the currency of the money.

**Example:**
```php
$currency = $money->getCurrency();
```

### `getCurrencySymbol(): ?string`

Returns the symbol of the currency.

**Example:**
```php
$symbol = $money->getCurrencySymbol();
// '€'
```

### `getDiscount(): int`

Returns the discount percentage.

**Example:**
```php
$money = new Money(100, Currency::EUR);
$money->setDiscount(10);
$discount = $money->getDiscount();
// 10
```

### `getDiscountValue(): float`

Returns the computed discount value.

**Example:**
```php
$money = new Money(100, Currency::EUR);
$money->setDiscount(25);
$discountValue = $money->getDiscountValue();
// 25.0
```

### `getFormatted(): string`

Returns the formatted value with the currency symbol.

**Example:**
```php
$formatted = $money->getFormatted();
// Example output: "$ 100.00"
```

### `add(Money $money): Money`

Adds the value of another `Money` object and returns a new `Money` object.

**Example:**
```php
$money1 = new Money(100, Currency::EUR);
$money2 = new Money(50, Currency::EUR);
$newMoney = $money1->add($money2);
// $newMoney has a value of 150 EUR
```

### `subtract(Money $money): Money`

Subtracts the value of another `Money` object and returns a new `Money` object.

**Example:**
```php
$newMoney = $money1->subtract($money2);
// $newMoney has a value of 50 EUR
```

### `multiply(Money $money): Money`

Multiplies the value by the value of another `Money` object and returns a new `Money` object.

**Example:**
```php
$newMoney = $money1->multiply($money2);
// $newMoney has a value of 5000 EUR (100 * 50)
```

### `divide(Money $money): Money`

Divides the value by the value of another `Money` object and returns a new `Money` object.

**Example:**
```php
$newMoney = $money1->divide($money2);
// $newMoney has a value of 2 EUR (100 / 50)
```

### `setDiscount(int $discount): Money`

Sets the discount percentage.

**Example:**
```php
$money->setDiscount(10);
// 10% discount applied
```

### `convert(Currency $currency): Money`

Converts the money to a different currency and returns a new `Money` object.

**Example:**
```php
$moneyInEur = $money->convert(Currency::EUR);
```

### `getEuroValue(): float`

Gets the value in EUR.

**Example:**
```php
$euroValue = $money->getEuroValue();
```

### `getValueIn(Currency $currency): float`

Gets the value in another currency.

**Example:**
```php
$valueInEUR = $money->getValueIn(Currency::EUR);
```

### `getTotal(array $moneys, Currency $currency = Currency::EUR): float`

Gets the total value of an array of `Money` objects in a specified currency.

**Example:**
```php
$total = Money::getTotal([$money1, $money2], Currency::EUR);
```

### `getAverage(array $moneys, Currency $currency = Currency::EUR): float`

Gets the average value of an array of `Money` objects in a specified currency.

**Example:**
```php
$average = Money::getAverage([$money1, $money2], Currency::EUR);
```

### `getHighest(array $moneys): Money`

Gets the highest value among an array of `Money` objects.

**Example:**
```php
$highest = Money::getHighest([$money1, $money2]);
```

### `getLowest(array $moneys): Money`

Gets the lowest value among an array of `Money` objects.

**Example:**
```php
$lowest = Money::getLowest([$money1, $money2]);
```

### `createModel(): MoneyModel`

Creates and returns a `MoneyModel` based on the current values.

**Example:**
```php
$model = $money->createModel();
```

### `getModel(): MoneyModel`

Returns the associated `MoneyModel`.

**Example:**
```php
$model = $money->getModel();
```

### `saveAsModel(): bool`

Saves the current values as a model.

**Example:**
```php
$success = $money->saveAsModel();
```

### `bind(MoneyModel $model): Money`

Binds an existing `MoneyModel` to the `Money` object.

**Example:**
```php
$money->bind($model);
```
