# Omnipay Thawani
Thawani gateway for Omnipay payment processing library
This package has implemtend the Checkout API of Thawani Payment systems
For more information please visit the following link:[Developer Document](https://docs.thawani.om/docs/thawani-ecommerce-api/YXBpOjExMDU2Mzgy-thawani-e-commerce-api)

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "behzadbabaei/omnipay-thawani": "dev-master"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require behzadbabaei/omnipay-thawani

## Basic Usage

1. Use Omnipay gateway class:

```php
    use Omnipay\Omnipay;
```

2. Initialize Thawani gateway:

```php

    $gateway = Omnipay::create('Thawani');
    $gateway->setPublishKey('publish-key');
    $gateway->setSecretKey('secret-key');
    $gateway->setAmount(31.90); // Amount to charge
    $gateway->setTransactionId(XXXX); // Transaction ID from your system

```

# Creating an session
Call purchase, it will return the response which includes the session_id for further process.
Please refer to the [Developer Document](https://docs.thawani.om/docs/thawani-ecommerce-api/b3A6MTEwNTYzODQ-create-session) for more information.

```php

```
OR

```php

```

# Retrieve an order
Please refer to the [Developer Document](https://docs.thawani.om/docs/thawani-ecommerce-api/b3A6MTEwNTYzODU-retrieve-session) for more information.

```php

```
OR

```php


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

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/behzadbabaei/omnipay-thawani/issues),
or better yet, fork the library and submit a pull request.

