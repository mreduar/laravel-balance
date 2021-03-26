# Laravel Balance

Maintains a history of balance movements in the eloquent models. This simple package will keep track of the balance of your models. You can increase, decrease, reset and set the balance. It is also possible to check if a model has a positive balance or no balance.


## Installation

You can install the package via composer:

``` bash
composer require mreduar/laravel-balance
```
You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="MrEduar\Balance\BalanceServiceProvider" --tag="migrations"
php artisan migrate
```
You can publish the config file with:

```bash
php artisan vendor:publish --provider="MrEduar\Balance\BalanceServiceProvider" --tag="config"
```
This is the contents of the published config file:

```
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table name
    |--------------------------------------------------------------------------
    |
    | Table name to use to store balance history transactions.
    |
    */

    'table' => 'balance_history',

];
```
## Usage

Adding the `HasBalance` trait will enable balance functionality on the Model.

``` php
use Illuminate\Foundation\Auth\User as Authenticatable;
use MrEduar\Balance\HasBalance;

class User extends Authenticatable
{
    use HasBalance;
}
```

#### Basic operations

```php
$user->increaseBalance(2575);
$user->balance; // 25.75

$user->decreaseBalance(2575);
$user->balance; // 0

$user->modifyBalance(-2537);
$user->balance; // -25.37

$user->modifyBalance(3037);
$user->balance; // 5
```

#### Reset balance

It's also possible to reset the balance and directly setting a new value.

```php
$user->resetBalance(); // 0

$user->resetBalance(10); // 10
```

#### Check if model has balance

Check if there is a positive balance or a balance greater than that provided.
```php
$user->hasBalance();
$user->hasBalance(2575);
```

#### Check if model has no balance

Check if there is no more balance.
```php
$user->hasNoBalance();
```

#### Add reference and description to history

It is possible to add a reference to any of the above methods by passing an array as a second parameter with the data of the referenced model and a description.
```php
use App\Models\Podcast;

$podcast = Podcast::find(1);

$user->decreaseBalance(2575, [
    'description' => 'Purchase of a podcast.',
    'reference' => $podcast
]);

$user->increaseBalance(2575, [
    'description' => 'Paypal Deposit.'
]);
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
