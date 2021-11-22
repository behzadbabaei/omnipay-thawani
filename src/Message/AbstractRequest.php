<?php

declare(strict_types=1);

namespace Omnipay\Thawani\Message;

use \Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Class AbstractRequest
 *
 * @package Omnipay\Thawani\Message
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    const MODE_PAYMENT = 'payment';

    /**
     * Gateway production endpoint.
     *
     * @var string $prodEndpoint
     */
    protected $prodEndpoint = 'https://checkout.thawani.om/';

    /**
     * @var string $sandboxEndpoint
     */
    protected $sandboxEndpoint = 'https://uatcheckout.thawani.om/';

    /**
     * @return string
     */
    abstract public function getEndpoint(): string;

    /**
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    abstract public function sendData($data);

    /**
     * Sets the request language.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * Get the request language.
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * Sets the request email.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * Get the request email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * Get url Depends on  test mode.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->getTestMode() ? $this->sandboxEndpoint : $this->prodEndpoint;
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
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [];
    }

    /**
     * /**
     * Set custom data to get back as is.
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
     * Get custom data.
     *
     * @return mixed
     */
    public function getCustomData()
    {
        return $this->getParameter('customData', []) ?? [];
    }
}
