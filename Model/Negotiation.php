<?php


namespace Mikielis\PriceNegotiation\Model;

use Mikielis\PriceNegotiation\Api\Data\NegotiationInterface;
use Mikielis\PriceNegotiation\Model\ResourceModel\Negotiation as NegotiationModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Negotiation model
 */
class Negotiation extends AbstractModel implements NegotiationInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'mikielis_negotiations';

    public function _construct()
    {
        $this->_init(NegotiationModel::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get store ID
     *
     * @return int|null
     */
    public function getStore()
    {
        return $this->getData(self::STORE);
    }

    /**
     * Set store ID
     *
     * @param int $id
     * @return $this
     */
    public function setStore($id)
    {
        return $this->setData(self::STORE, $id);
    }

    /**
     * Get product ID
     *
     * @return int|null
     */
    public function getProduct()
    {
        return $this->getData(self::PRODUCT);
    }

    /**
     * Set product ID
     *
     * @param int $id
     * @return $this
     */
    public function setProduct($id)
    {
        return $this->setData(self::PRODUCT, $id);
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Set email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get phone
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * Get price
     *
     * @return float|null
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * Set price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * Get currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->getData(self::CURRENCY);
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        return $this->setData(self::CURRENCY, $currency);
    }

    /**
     * Get quantity
     *
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->getData(self::QUANTITY);
    }

    /**
     * Set quantity
     *
     * @param $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        return $this->setData(self::QUANTITY, $quantity);
    }

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * Set message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Get datetime
     *
     * @return string|null
     */
    public function getDatetime()
    {
        return $this->getData(self::DATETIME);
    }

    /**
     * Set datetime
     *
     * @param string $datetime Y-m-d H:i:s
     * @return $this
     */
    public function setDatetime($datetime)
    {
        return $this->setData(self::DATETIME, $datetime);
    }

    /**
     * Get admin notification
     *
     * @return boolean|null
     */
    public function getAdminNotification()
    {
        return $this->getData(self::ADMIN_NOTIFICATION);
    }

    /**
     * Set admin notification
     *
     * @param boolean $notification
     * @return $this
     */
    public function setAdminNotification($notification)
    {
        return $this->setData(self::ADMIN_NOTIFICATION, $notification);
    }

    /**
     * Get status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get status datetime
     *
     * @return string|null
     */
    public function getStatusDatetime()
    {
        return $this->getData(self::STATUS_DATETIME);
    }

    /**
     * Set status datetime
     *
     * @param string $datetime
     * @return $this
     */
    public function setStatusDatetime($datetime)
    {
        return $this->setData(self::STATUS_DATETIME, $datetime);
    }
}
