
[<img src="https://alet-systems.net/brand/AletPayment-Logo-(Full-Color).png" />](https://alet-systems.net)

# AletPayment Laravel API Package.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alet-systems/alet-systems.svg?style=flat-square)](https://packagist.org/packages/alet-systems/alet-systems)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/alet-systems/alet-systems/run-tests?label=tests)](https://github.com/alet-systems/alet-systems/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/alet-systems/alet-systems/Check%20&%20fix%20styling?label=code%20style)](https://github.com/alet-systems/alet-systems/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/alet-systems/alet-systems.svg?style=flat-square)](https://packagist.org/packages/alet-systems/alet-systems)

## Documentation

See the [`Developer` API docs](https://developer.alet-systems.net/).


## Installation

You can install the package via composer:

```bash
composer require alet-systems/alet-payment
```

## For Laravel version <= 5.4

With version 5.4 or below, you must register your facades manually in the aliases section of the config/app.php configuration file.


```json config/app.php

"aliases": {
            "AletPayment": "AletPayment\\AletPayment\\Facades\\AletPayment"
        }
```

## Usage

The package needs to be configured with your account's API key, which is
available in the [AletPayment Dashboard](https://dashboard.alet-systems.net/app/api). Require it with the key's
value. After install the package. you can use as follow.

 > :warning: Since V2 ``AletPayment->create()`` is deprecated and ``AletPayment->checkout->create()`` should be used.

```php
use AletPayment\AletPayment\AletPayment;

...

$alet-systems = new AletPayment('your-api-key');

```


## Creating Checkout Session

After importing the `alet-systems` package, use the checkout property of the AletPayment instance to create or fetch `checkout sessions`.


```php

use AletPayment\AletPayment\AletPayment;
use AletPayment\AletPayment\Helper\AletPaymentSupport;
use AletPayment\AletPayment\Lib\AletPaymentBeneficary;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutItem;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutRequest;
use AletPayment\AletPayment\Lib\AletPaymentOptions;

use Illuminate\Support\Carbon;

$alet-systems = new AletPayment('your-api-key');
$d = new  Carbon::now();
$d->setMonth(10);
$expired = AletPaymentSupport::getExpireDateFromDate($d);
$data = new AletPaymentCheckoutRequest(
    cancel_url: 'https://api.alet-systems.com',
    error_url: 'https://api.alet-systems.com',
    notify_url: 'https://gateway.alet-systems.net/test/callback',
    expireDate: $expired,
    nonce: floor(rand() * 10000) . "",
    beneficiaries: [
        AletPaymentBeneficary::fromJson([
            "accountNumber" => '01320811436100',
            "bank" => 'AWINETAA',
            "amount" => 10.0,
        ]),
    ],
    paymentMethods: ["CARD"],
    success_url: 'https://gateway.alet-systems.net',
    items: [
        AletPaymentCheckoutItem::fromJson([
            "name" => 'Bannana',
            "price" => 10.0,
            "quantity" => 1,
        ]),
    ],
);
$session =  $alet-systems->checkout->create($data, new AletPaymentOptions(sandbox: true));
echo $session->session_id;

```

::Note 
    you Must use `use Illuminate\Support\Carbon` instead of `use Carbon\Carbon` to get the expire date
    

After putting your building  `AletPaymentCheckoutRequest` just call the `create` method. Note passing `sandbox: true` option will create the session in test environment.

This is session response object contains the following fields

```js
{
  sessionId: string;
  paymentUrl: string;
  cancelUrl: string;
  totalAmount: number;
}
```

## Getting Session by Session ID

To track the progress of a checkout session you can use the fetch method as shown below:

```php
 $alet-systems = new AletPayment('API KEY...');
// A sessionId will be returned when creating a session.
 $session = $alet-systems->checkout->fetch('checkOutSessionID', new AletPaymentOptions(true));
```

The following object represents a session

```php
{
  public int $id, 
  public AletPaymentTransaction $transcation, 
  public float $totalAmount, 
  public bool $test,  
  public string $uuid, 
  public string $created_at, 
  public string $update_at
}
```

## Cancel Session by Session ID

If the merchant want to cancel a checkout session. it's now possible as shown below.

```php
 $alet-systems = new AletPayment('API KEY...');
// A sessionId will be returned when creating a session.
 $session = $alet-systems->checkout->cancel('checkOutSessionID', new AletPaymentOptions(true));
```

The `AletPaymentCheckoutSession` class is returned.

## DirectPay

learn more about [DirectPay here](https://developer.alet-systems.net/docs/direcPay/overview)
### DirectPay for telebirr
```php 
     $session = $alet-systems->checkout->create($data, new AletPaymentOptions(true));

    return $alet-systems->directPay->telebirr->pay($session->session_id);
```

### DirectPay for awash wallet
```php 
     $session = $alet-systems->checkout->create($data, new AletPaymentOptions(true));

    return $alet-systems->directPay->awash_wallet->pay($session->session_id);
```

### DirectPay for awash
```php 
     $session = $alet-systems->checkout->create($data, new AletPaymentOptions(true));

    return $alet-systems->directPay->awash->pay($session->session_id);
```

# Change Log

Released Date: `v1.0.0` June 09, 2022

- Initial Release

Released Date: `v1.2.0` June 30, 2022

- Name space changed. use AletPayment/AletPayment
- Exception Handling Improved

Released Date: `v1.3.0` June 30, 2022

- `expiredate` parameter in checkout session create formate changed to LocalDateTime format
- Exception Handling For Non Exsisting Session

Released Date: `v2.0.0` Aug 10, 2022

- `DirectPay` added for Telebirr and Awash payment options


## More Information

- [DirectPay](https://developer.alet-systems.net/docs/direcPay/overview)
- [Check Full Example](https://github.com/AletPayment-net/Laravel-sample)
- [REST API Version](https://developer.alet-systems.net/docs/checkout/overview)
- [Mobile SDK](https://developer.alet-systems.net/docs/clientSDK/overview)
- [Change Log](https://developer.alet-systems.net/docs/nodejs/changelog)
- [Node JS](https://developer.alet-systems.net/docs/nodejs/overview)
- [Laravel](https://developer.alet-systems.net/docs/laravel/overview)
- [Change Log](https://developer.alet-systems.net/docs/laravel/changelog)

## Credits

- [basliel](https://github.com/ba5liel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
