<?php

namespace Mikielis\PriceNegotiation\Api;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Mikielis\PriceNegotiation\Api\Data\NegotiationInterface;

Interface NegotiationRepositoryInterface
{
    /**
     * Get offer by ID
     *
     * @param int $offerId
     * @return NegotiationInterface
     * @throws LocalizedException
     */
    public function get($offerId);

    /**
     * Get contact details - email and name
     *
     * @param int $offerId
     * @return array
     * @throws LocalizedException
     */
    public function getContactInfo($offerId);

    /**
     * @param int $offerId
     * @return ProductInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getProduct($offerId);

    /**
     * Get Store or website name
     *
     * @param int $offerId
     * @param string $type
     * @return bool|string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getStore($offerId, $type);

    /**
     * Reject offer
     * Change status to rejected
     *
     * @param int $offerId
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function reject($offerId);

    /**
     * Save offer
     *
     * @param int $storeId
     * @param array $data
     * @return void
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function save($storeId, $data);

    /**
     * Delete offer
     *
     * @param int $offerId
     * @return void
     * @throws Exception
     */
    public function delete($offerId);

    /**
     * Mass delete
     *
     * @param array $ids
     * @return int
     * @throws Exception
     */
    public function massDelete($ids);
}