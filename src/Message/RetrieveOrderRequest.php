<?php

declare(strict_types = 1);

namespace Omnipay\Thawani\Message;

use function array_merge;
use function json_encode;

/**
 * Class RetrieveOrderRequest
 *
 * @package Omnipay\Thawani\Message
 */
class RetrieveOrderRequest extends AbstractRequest
{
    /**
     * Sets the request orderId.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    /**
     * Get the request orderId.
     *
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    /**
     * Prepare data to send
     *
     * @return array
     */
    public function getData() : array
    {
        return array_merge($this->getCustomData(), []);
    }

    /**
     * Send data and return response instance.
     *
     * https://docs.thawani.om/docs/thawani-ecommerce-api/b3A6MTEwNTYzODU-retrieve-session
     *
     * @param mixed $body
     *
     * @return mixed
     */
    public function sendData($body)
    {
        $headers = [
            'thawani-api-key' => $this->getSecretKey(),
            'Content-Type' => 'application/json'
        ];

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $headers,
            json_encode($body)
        );

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod() : string
    {
        return 'GET';
    }

    /**
     * @param       $data
     * @param array $headers
     *
     * @return Response
     */
    protected function createResponse($data, $headers = []) : Response
    {
        return $this->response = new Response($this, $data, $headers);
    }

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        $orderId = $this->getOrderId();

        return $this->getUrl().'api/v1/checkout/session/'.$orderId;
    }
}
