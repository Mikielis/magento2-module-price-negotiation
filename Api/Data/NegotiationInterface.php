<?php

namespace Mikielis\PriceNegotiation\Api\Data;

Interface NegotiationInterface
{
    const OFFER_ID = 'offer_id';

    const STORE = 'store_id';

    const PRODUCT = 'product_id';

    const NAME = 'name';

    const EMAIL = 'email';

    const PHONE = 'phone';

    const PRICE = 'price';

    const CURRENCY = 'currency';

    const QUANTITY = 'quantity';

    const MESSAGE = 'message';

    const DATETIME = 'datetime';

    const ADMIN_NOTIFICATION = 'admin_notification';

    const STATUS = 'status';

    const STATUS_NEW = 'New';

    const STATUS_REJECTED = 'Rejected';

    const STATUS_DATETIME = 'status_datetime';

    /**
     * Get offer ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get store ID
     *
     * @return int|null
     */
    public function getStore();

    /**
     * Set store ID
     *
     * @param int $id
     * @return $this
     */
    public function setStore($id);

    /**
     * Get product ID
     *
     * @return int|null
     */
    public function getProduct();

    /**
     * Set product ID
     *
     * @param int $id
     * @return $this
     */
    public function setProduct($id);

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * Get phone
     *
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone);

    /**
     * Get price
     *
     * @return float|null
     */
    public function getPrice();

    /**
     * Set price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * Get currency
     *
     * @return string|null
     */
    public function getCurrency();

    /**
     * Set currency
     *
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency);

    /**
     * Get quantity
     *
     * @return int|null
     */
    public function getQuantity();

    /**
     * Set quantity
     *
     * @param $quantity
     * @return $this
     */
    public function setQuantity($quantity);

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message);

    /**
     * Get datetime
     *
     * @return string|null
     */
    public function getDatetime();

    /**
     * Set datetime
     *
     * @param string $datetime Y-m-d H:i:s
     * @return $this
     */
    public function setDatetime($datetime);

    /**
     * Get admin notification
     *
     * @return boolean|null
     */
    public function getAdminNotification();

    /**
     * Set admin notification
     *
     * @param boolean $notification
     * @return $this
     */
    public function setAdminNotification($notification);

    /**
     * Get status
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get status datetime
     *
     * @return string|null
     */
    public function getStatusDatetime();

    /**
     * Set status datetime
     *
     * @param string $datetime
     * @return $this
     */
    public function setStatusDatetime($datetime);
}
