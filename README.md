# Omnipay: PayTabs

**PayTabs driver for the Omnipay PHP payment processing library**

[![Latest Stable Version](https://poser.pugx.org/jestillore/omnipay-paytabs/version.png)](https://packagist.org/packages/jestillore/omnipay-paytabs)
[![Total Downloads](https://poser.pugx.org/jestillore/omnipay-paytabs/d/total.png)](https://packagist.org/packages/jestillore/omnipay-paytabs)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements PayTabs support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "jestillore/omnipay-paytabs": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* PayTabs

Create a Gateway instance:
```php
$gateway = Omnipay::create('PayTabs');
$gateway->setMerchantEmail('email@example.com');
$gateway->setSecretKey('SECRET_KEY');
$gateway->setSiteUrl('http://example.com');
$gateway->setMerchantIp('192.168.143.44');
```

Validate Secret Key:
```php
$response = $gateway->validateSecretKey()->send();
if ($response->isSuccessful())
{
    // secret key valid
}
else
{
    // secret key invalid
}
```

Purchase:
```php
$card = new CreditCard(array(
	'firstName' => 'John',
	'lastName' => 'doe',
	'address1' => 'Address One',
	'address2' => 'Address Two',
	'city' => 'Sampe City',
	'postCode' => '1234',
	'state' => '', // When the country is selected as USA or CANADA, the statfield should contain a string of 2 characters containing the ISO state code otherwise the payments may be rejected. For other countries, the state can be a string of up to 32 characters.
	'country' => 'PHL', // 3 characters ISO code
	'phone' => '639123456789',
	'email' => 'email@example.com'
));

$items = new ItemBag();

$item1 = new Item(array(
	'name' => 'One',
	'price' => 10,
	'quantity' => 2
	));

$item2 = new Item(array(
	'name' => 'Two',
	'price' => 20,
	'quantity' => 3
	));

$items->add($item1);
$items->add($item2);

$purchase = $gateway->purchase(array(
	'card' => $card,
	'amount' => '80.00',
	'currency' => 'PHP',
	'transactionId' => '123456789',
	'clientIp' => '192.168.1.2',
	'returnUrl' => 'http://example.com/complete_purchase',
	'title' => 'Bill',
	'items' => $items
));

$data = $purchase->getData();

// other_charges and discount fields are required
$data['other_charges'] = '0';
$data['discount'] = '0';

$response = $purchase->sendData($data);

if ($response->isSuccessful())
{
	// always returns false since PayTabs is an off-site gateway
}
else if ($response->isRedirect())
{
    // always returns false since PayTabs is an off-site gateway
	$response->redirect();
}
else
{
	// paypage is not created
}
```

Create Recurring Pay Page:
```php
// You need to pass all the same parameters used for create pay page, in addition to the following fields

$data = $purchase->getData();

// set is recurrence to true
$data['is_recurrence_payments'] = 'TRUE';

// Start date on which this recurrence should start with the format DD/MM/YYYY. Date must be a future date.
$data['recurrence_start_date'] = '24/04/2015';

// Frequency is how many times you want to bill your customer. Maximum number of allowed recurrences is 24
$data['recurrence_frequency'] = '4';

// What billing cycle you are going to use (monthly , weekly, daily, yearly)
$data['recurrence_billing_cycle'] = 'monthly';

$response = $purchase->sendData($data);

if ($response->isSuccessful())
{
	// always returns false since PayTabs is an off-site gateway
}
else if ($response->isRedirect())
{
    // always returns false since PayTabs is an off-site gateway
	$response->redirect();
}
else
{
	// paypage is not created
}
```

Create Tokenization Profile for Customers
```php
// You need to pass all the same parameters used for create pay page, in addition to the following fields

$data = $purchase->getData();

// set is tokenization to true
$data['is_tokenization'] = 'TRUE';

// FALSE: If you want to create an existing token
// TRUE: If you want to use an existing token for a returning
$data['is_existing_customer'] = 'FALSE';

// This pt_token is received in the API post response after completing the payment; it will be redirected to return_url. While returning back to that URL, iwill send a POST request to that page.
$data['pt_token'] = 'R7ANsPK1q91fv5QObmQ3';

// The customer email linked to the tokenization profile used, by default when the profile is created at the first successful payment, it will use customer_email value sent in the API to link it to the token.
$data['pt_customer_email'] = 'email@example.com';

// This pt_ customer_password is received in the API post response after completing the payment; it will be redirected to return_url. While returning back to that URL, it will send a POST request to that page.
$data['pt_customer_password'] = '1q91fv5QOb';

$response = $purchase->sendData($data);

if ($response->isSuccessful())
{
	// always returns false since PayTabs is an off-site gateway
}
else if ($response->isRedirect())
{
    // always returns false since PayTabs is an off-site gateway
	$response->redirect();
}
else
{
	// paypage is not created
}
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/thephpleague/omnipay-2checkout/issues),
or better yet, fork the library and submit a pull request.

