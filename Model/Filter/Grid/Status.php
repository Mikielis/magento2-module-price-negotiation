<?php

namespace Mikielis\PriceNegotiation\Model\Filter\Grid;

use Magento\Framework\Data\OptionSourceInterface;
use Mikielis\PriceNegotiation\Api\Data\NegotiationInterface;

class Status implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            ['value' => NegotiationInterface::STATUS_NEW, 'label' => NegotiationInterface::STATUS_NEW],
            ['value' => NegotiationInterface::STATUS_REJECTED, 'label' => NegotiationInterface::STATUS_REJECTED]
        ];
    }
}