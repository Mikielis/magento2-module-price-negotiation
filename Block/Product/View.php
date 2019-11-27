<?php

namespace Mikielis\PriceNegotiation\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Helper\Data as ProductHelper;
use Mikielis\PriceNegotiation\Helper\Data as DataHelper;

class View extends Template
{
    /**
     * @var ProductHelper;
     */
    protected $productHelper;

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    public function __construct(
        Context $context,
        array $data = [],
        ProductHelper $productHelper,
        DataHelper $dataHelper
    ) {
        $this->productHelper = $productHelper;
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    /**
     * Is module enabled/disabled
     *
     * @return bool
     */
    public function isModuleEnabled()
    {
        return (boolean) $this->dataHelper->getConfig('mikielis_negotiation/functional/enable');
    }

    /**
     * Get form action
     *
     * @return string
     */
    public function getFormAction()
    {
        return '/mikielis-negotiation/form/send';
    }

    /**
     * Get product ID
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->productHelper->getProduct()->getId();
    }
}
