<?php

namespace Mikielis\PriceNegotiation\Block\Negotiation;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Helper\Data as ProductHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Mikielis\PriceNegotiation\Api\Data\NegotiationInterface;
use Mikielis\PriceNegotiation\Model\NegotiationRepository;

class View extends Template
{
    /**
     * @var ProductHelper
     */
    protected $productHelper;

    /**
     * @var NegotiationRepository
     */
    protected $negotiationRepository;

    /**
     * View constructor.
     *
     * @param Context $context
     * @param array $data
     * @param ProductHelper $productHelper
     * @param NegotiationRepository $negotiationRepository
     */
    public function __construct(
        Context $context,
        array $data = [],
        ProductHelper $productHelper,
        NegotiationRepository $negotiationRepository
    ) {
        $this->productHelper = $productHelper;
        $this->negotiationRepository = $negotiationRepository;
        parent::__construct($context, $data);
    }

    /**
     * Get negotiation offer
     *
     * @return NegotiationInterface
     * @throws LocalizedException
     */
    public function getNegotiation()
    {
        $negotiationOffer = $this->negotiationRepository->get((int)$this->getRequest()->getParam('id'));
        return $negotiationOffer;
    }

    /**
     * Get product details
     *
     * @return ProductInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getProduct()
    {
        $product = $this->negotiationRepository->getProduct((int)$this->getRequest()->getParam('id'));
        return $product;
    }

    /**
     * Get store
     *
     * @param string $type store/website
     * @return bool|string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getStore($type)
    {
        $name = $this->negotiationRepository->getStore((int)$this->getRequest()->getParam('id'), $type);
        return $name;
    }

    /**
     * Is offer rejected
     *
     * @return bool
     * @throws LocalizedException
     */
    public function isRejected()
    {
        $offer = $this->getNegotiation((int)$this->getRequest()->getParam('id'));
        return $offer->getStatus() === NegotiationInterface::STATUS_REJECTED;
    }
}
