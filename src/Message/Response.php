<?php

declare(strict_types=1);

namespace Omnipay\Thawani\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

use Throwable;
use function json_decode;
use function in_array;

/**
 * Thawani Response.
 *
 * This is the response class for all Thawani requests.
 *
 * @see \Omnipay\Thawani\Gateway
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    const STATUS_PAID = 'paid';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;

    /**
     * @var array
     */
    protected $headers = [];

    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        parent::__construct($request, $data);

        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }

    /**
     * Is the transaction in processing status?
     *
     * @return bool
     */
    public function isProcessing(): bool
    {
        return $this->getOrderStatus() == self::STATUS_UNPAID;
    }

    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        if ($this->getOrderStatus()) {
            return $this->isCompleted() && $this->isNotError();
        }

        return $this->isNotError();
    }

    /**
     * Is the response no error
     *
     * @return bool
     */
    public function isNotError(): bool
    {
        return in_array($this->getCode(), [self::STATUS_CANCELLED, self::STATUS_UNPAID]);
    }

    /**
     * Is the orderStatus completed
     * Full authorization of the order amount
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return in_array($this->getOrderStatus(), [self::STATUS_PAID]);
    }

    /**
     * @return bool
     */
    public function isRedirect(): bool
    {
        return true;
    }

    /**
     * Get response redirect url
     *
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        try {
            $paymentUrl = $this->request->getUrl() . 'pay/{session_id}?key={publishable_key}';
            $sessionId = $this->data['data']['session_id'];
            $publishKey = $this->request->getPublishKey();

            $mainUrl = str_replace('{session_id}', $sessionId, $paymentUrl);
            $mainUrl = str_replace('{publishable_key}', $publishKey, $mainUrl);

            return $mainUrl;
        } catch (Throwable $exception) {
            return null;
        }
    }

    /**
     * Get the orderStatus.
     *
     * @return |null
     */
    public function getOrderStatus()
    {
        if (isset($this->data['data']['payment_status'])) {
            return strtolower($this->data['data']['payment_status']);
        }

        return null;
    }

    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return null;
    }

    /**
     * Get the error code from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return null;
    }
}
