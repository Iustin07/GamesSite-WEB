<?php


class Order
{
    private $orderId;
    private $userId;
    private $payment;
    private $finalized;

    /**
     * Order constructor.
     * @param $userId
     * @param $payment
     */
    public function __construct( $userId, $payment)
    {
        $this->userId = $userId;
        $this->payment = $payment;
        $this->finalized = 'no';
    }

    /**
     * @return string
     */
    public function getFinalized(): string
    {
        return $this->finalized;
    }

    /**
     * @param string $finalized
     */
    public function setFinalized(string $finalized): void
    {
        $this->finalized = $finalized;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }

}