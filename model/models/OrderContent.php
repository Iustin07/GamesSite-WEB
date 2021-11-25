<?php


class OrderContent
{
    private $orderId;
    private $productId;

    /**
     * OrderContent constructor.
     * @param $orderId
     * @param $productId
     */
    public function __construct($orderId, $productId)
    {
        $this->orderId = $orderId;
        $this->productId = $productId;
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
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

}