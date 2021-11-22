<?php

declare(strict_types=1);

namespace Omnipay\Thawani\Message;

use function array_merge;
use function json_encode;

/**
 * Class PurchaseRequest
 *
 * @package Omnipay\Thawani\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * Sets the request paymentMode.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPaymentMode($value)
    {
        return $this->setParameter('paymentMode', $value);
    }

    /**
     * Get the request paymentMode.
     *
     * @return mixed
     */
    public function getPaymentMode()
    {
        return $this->getParameter('paymentMode');
    }

    /**
     * Sets the request quantity.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    /**
     * Get the request quantity.
     *
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->getParameter('quantity');
    }

    /**
     * Sets the request productName.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setProductName($value)
    {
        return $this->setParameter('productName', $value);
    }

    /**
     * Get the request productName.
     *
     * @return mixed
     */
    public function getProductName()
    {
        return $this->getParameter('productName');
    }

    /**
     * Sets the request planId.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPlanId($value)
    {
        return $this->setParameter('planId', $value);
    }

    /**
     * Get the request planId.
     *
     * @return mixed
     */
    public function getPlanId()
    {
        return $this->getParameter('planId');
    }

    /**
     * Sets the request customerId.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    /**
     * Get the request customerId.
     *
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    /**
     * Sets the request saveCardOnSuccess.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSaveCardOnSuccess($value)
    {
        return $this->setParameter('saveCardOnSuccess', $value);
    }

    /**
     * Set the request metadata.
     *
     * @param array $value
     *
     * @return $this
     */
    public function setMetadata(array $value)
    {
        return $this->setParameter('metadata', $value);
    }

    /**
     * Get the request metadata.
     *
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->getParameter('metadata', []);
    }

    /**
     * Get the request saveCardOnSuccess.
     *
     * @return mixed
     */
    public function getSaveCardOnSuccess()
    {
        return $this->getParameter('saveCardOnSuccess');
    }

    /**
     * Prepare the data for creating the order.
     *
     * https://docs.thawani.om/docs/thawani-ecommerce-api/b3A6MTEwNTYzODQ-create-session
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'quantity',
            'returnUrl',
            'cancelUrl',
            'amount',
            'productName',
            'transactionId',
            'metadata'
        );

        return array_merge($this->getCustomData(), [
            'client_reference_id' => $this->getTransactionId(),
            'mode' => $this->getPaymentMode() ?? self::MODE_PAYMENT,
            'products' => [
                [
                    'name' => $this->getProductName(),
                    'quantity' => $this->getQuantity(),
                    'unit_amount' => (integer)$this->getAmount() //converted to OMR,
                ]
            ],
            'customer_id' => $this->getCustomerId() ?? '',
            'success_url' => $this->getReturnUrl(),
            'cancel_url' => $this->getCancelUrl(),
            'save_card_on_success' => $this->getSaveCardOnSuccess() ?? false,
            'plan_id' => $this->getPlanId() ?? '',
            'metadata' => $this->getMetadata(),
        ]);
    }

    /**
     * Send data and return response instance.
     *
     * @param mixed $body
     *
     * @return mixed
     */
    public function sendData($body)
    {
        $headers = [
            'thawani-api-key' => $this->getSecretKey(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
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
     * @param       $data
     * @param array $headers
     *
     * @return Response
     */
    protected function createResponse($data, $headers = []): Response
    {
        return $this->response = new Response($this, $data, $headers);
    }

    /**
     * Get the order create endpoint.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->getUrl() . 'api/v1/checkout/session';
    }
}
