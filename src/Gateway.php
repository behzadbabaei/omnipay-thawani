<?php

declare(strict_types = 1);

namespace Omnipay\Thawani;

use Omnipay\Common\AbstractGateway;
use Omnipay\Thawani\Message\PurchaseRequest;
use Omnipay\Thawani\Message\RetrieveOrderRequest;

/**
 * Braintree Gateway
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 */
class Gateway extends AbstractGateway
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'Thawani';
    }

    /**
     * Get default parameters
     *
     * @return array|mixed
     */
    public function getDefaultParameters()
    {
        return [
            'publishKey' => '',
            'secretKey' => '',
        ];
    }

    /**
     * Sets the request Secret Key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    /**
     * Get the request Secret Key.
     *
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * Sets the request Publish Key
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPublishKey($value)
    {
        return $this->setParameter('publishKey', $value);
    }

    /**
     * Get the request Publish Key.
     *
     * @return mixed
     */
    public function getPublishKey()
    {
        return $this->getParameter('publishKey');
    }

    /**
     * Set custom data to get back as is
     *
     * @param array $value
     *
     * @return $this
     */
    public function setCustomData(array $value)
    {
        return $this->setParameter('customData', $value);
    }

    /**
     * Get custom data
     *
     * @return mixed
     */
    public function getCustomData()
    {
        return $this->getParameter('customData');
    }

    /**
     * Create a purchase request
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = array())
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Create a retrieve order request
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function fetchTransaction(array $options = array())
    {
        return $this->createRequest(RetrieveOrderRequest::class, $options);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}
