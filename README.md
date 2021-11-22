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
            $gateway->setTestMode(true-false);

```

# Creating an session
Call purchase, it will return the response which includes the session_id for further process.
Please refer to the [Developer Document](https://docs.thawani.om/docs/thawani-ecommerce-api/b3A6MTEwNTYzODQ-create-session) for more information.

```php

            $purchase = $gateway->purchase();
            $purchase->setAmount(12000);
            $purchase->setQuantity(1);
            $purchase->setProductName("product name test1"); //Product name is required
            $purchase->setTransactionId($data['transactionId']); //TransactionId is required
            $purchase->setCustomerId('');
            $purchase->setReturnUrl('https://www.example.com/thawani/success'); //The success url is required
            $purchase->setCancelUrl('https://www.example.com/thawani/cancel');  //The cancel url is required
            $purchase->setSaveCardOnSuccess(false);
            $purchase->setPlanId('');
            // The metadata about the customer is required, like name, email
            $purchase->setMetadata([
                'orderId' => $data['transactionId'],
                'customerId' => $data['customerId'] ?? null,
                'customerEmail' => $data['customerEmail'] ?? null,
                'customerName' => $data['customerName'] ?? null,// user full name
            ]);

            $result = $purchase->send();
            $response = $result->getData();
            $redirectUrl = $result->getRedirectUrl();

```
OR
```php
            $result = $gateway->purchase([
                'amount' => 12000,
                'quantity' => 1,
                'productName' => 'product name test2',
                'transactionId' => $data['transactionId'],
                'customerId' => '',
                'returnUrl' => 'https://www.example.com/thawani/success',
                'cancelUrl' => 'https://www.example.com/thawani/cancel',
                'saveCardOnSuccess' => false,
                'planId' => '',
                'metadata' => [
                    'orderId' => $data['transactionId'],
                    'customerId' => $data['customerId'] ?? null,
                    'customerEmail' => $data['customerEmail'] ?? null,
                    'customerName' => $data['customerName'] ?? null,// user full name
                ]
            ])->send();

            $response = $result->getData();
            $redirectUrl = $result->getRedirectUrl();

```

# Retrieve an order
Please refer to the [Developer Document](https://docs.thawani.om/docs/thawani-ecommerce-api/b3A6MTEwNTYzODU-retrieve-session) for more information.

```php

            $fetch = $gateway->fetchTransaction();
            $fetch->setOrderId($orderId);
            $result = $fetch->send()->getData();

```
OR
```php

            $fetch = $gateway->fetchTransaction(
                [
                    'orderId' => $orderId
                ]
            );
            $result = $fetch->send()->getData();

```


For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/behzadbabaei/omnipay-thawani/issues),
or better yet, fork the library and submit a pull request.

