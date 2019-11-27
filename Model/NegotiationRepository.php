<?php

namespace Mikielis\PriceNegotiation\Model;

use Exception;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Mikielis\PriceNegotiation\Api\Data\NegotiationInterface;
use Mikielis\PriceNegotiation\Api\NegotiationRepositoryInterface;
use Mikielis\PriceNegotiation\Model\ResourceModel\Negotiation as NegotiationResource;

class NegotiationRepository implements NegotiationRepositoryInterface
{
    /**
     * @var Negotiation
     */
    protected $negotiationFactory;

    /**
     * @var Negotiation
     */
    protected $negotiationResource;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * NegotiationRepository constructor.
     *
     * @param NegotiationFactory $negotiationFactory
     * @param NegotiationResource $negotiationResource
     * @param StoreManagerInterface $storeManager
     * @param ProductRepositoryInterface $productRepository
     * @param Filter $filter
     */
    public function __construct(
        NegotiationFactory $negotiationFactory,
        NegotiationResource $negotiationResource,
        StoreManagerInterface $storeManager,
        ProductRepositoryInterface $productRepository
    ) {
        $this->negotiationFactory = $negotiationFactory;
        $this->negotiationResource = $negotiationResource;
        $this->storeManager = $storeManager;
        $this->productRepository = $productRepository;
    }

    /**
     * Get offer by ID
     *
     * @param int $offerId
     * @return NegotiationInterface
     * @throws LocalizedException
     */
    public function get($offerId)
    {
        $offer = $this->negotiationFactory->create();
        $data = $this->negotiationResource->getById((int)$offerId);
        $offer->setData($data);

        return $offer;
    }

    /**
     * Get contact details - email and name
     *
     * @param int $offerId
     * @return array
     * @throws LocalizedException
     */
    public function getContactInfo($offerId)
    {
        $offer = $this->get($offerId);

        return [
            'email' => $offer->getEmail(),
            'name' => $offer->getName()
        ];
    }

    /**
     * @param int $offerId
     * @return ProductInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getProduct($offerId)
    {
        $offer = $this->negotiationFactory->create();
        $data = $this->negotiationResource->getById((int)$offerId);
        $offer->setData($data);
        $product = $this->productRepository->getById($offer->getProduct());

        return $product;
    }

    /**
     * Get Store or website name
     *
     * @param int $offerId
     * @param string $type
     * @return bool|string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getStore($offerId, $type)
    {
        $offer = $this->negotiationFactory->create();
        $data = $this->negotiationResource->getById((int)$offerId);
        $offer->setData($data);
        $storeId = $offer->getStore();
        $websiteId = $this->storeManager->getStore($storeId)->getWebsiteId();
        $storeGroupId = $this->storeManager->getStore($storeId)->getStoreGroupId();
        $ret = false;

        switch ($type) {
            case 'website':
                $ret = $this->storeManager->getWebsite($websiteId)->getName();
                break;
            case 'store':
                $ret = $this->storeManager->getGroup($storeGroupId)->getName();
                break;
        }

        return $ret;
    }

    /**
     * Reject offer
     * Change status to rejected
     *
     * @param int $offerId
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function reject($offerId)
    {
        $offer = $this->get($offerId);
        $offer->setStatus(NegotiationInterface::STATUS_REJECTED);
        $offer->setStatusDatetime(date('Y-m-d H:i:s'));
        $this->negotiationResource->save($offer);
    }

    /**
     * Save offer
     *
     * @param int $storeId
     * @param array $data
     * @return void
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function save($storeId, $data)
    {
        /** @var Negotiation $model */
        $offer = $this->negotiationFactory->create();
        $offer->setData($data);

        if (!$offer->getStore()) {
            $offer->setStore($storeId);
        }

        if (!$offer->getAdminNotification()) {
            $offer->setAdminNotification(false);
        }

        if (!$offer->getDatetime()) {
            $offer->setDatetime(date('Y-m-d H:i:s'));
        }

        if (!$offer->getPrice()) {
            $offer->setPrice($data['requested_price']);
        }

        if (!$offer->getCurrency()) {
            $offer->setCurrency($this->storeManager->getStore()->getCurrentCurrency()->getCode());
        }

        if (!$offer->getStatus()) {
            $offer->setStatus(NegotiationInterface::STATUS_NEW);
        }

        $this->negotiationResource->save($offer);
    }

    /**
     * Delete offer
     *
     * @param int $offerId
     * @return void
     * @throws Exception
     */
    public function delete($offerId)
    {
        $offer = $this->negotiationFactory->create();
        $offer->setId($offerId);
        $this->negotiationResource->delete($offer);
    }

    /**
     * Mass delete
     *
     * @param array $ids
     * @return int
     * @throws Exception
     */
    public function massDelete($ids)
    {
        $count = 0;

        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $count++;
                $this->delete($id);
            }
        }

        return $count;
    }
}
