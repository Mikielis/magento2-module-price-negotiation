<?php

namespace Mikielis\PriceNegotiation\Model\ResourceModel\Negotiation;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mikielis\PriceNegotiation\Model\Negotiation as NegotiationModel;
use Mikielis\PriceNegotiation\Model\ResourceModel\Negotiation as NegotiationResourceModel;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(NegotiationModel::class, NegotiationResourceModel::class);
    }
}