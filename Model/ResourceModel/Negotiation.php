<?php

namespace Mikielis\PriceNegotiation\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Negotiation extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mikielis_price_negotiations', 'offer_id');
    }

    /**
     * @param $offerId
     * @return array
     * @throws LocalizedException
     */
    public function getById($offerId)
    {
        $connection = $this->getConnection();
        $select = $connection->select()->from(
            $this->getMainTable()
        )->where(
            $this->getIdFieldName() . '=:' . $this->getIdFieldName()
        );
        $bind = [$this->getIdFieldName() => $offerId];
        $negotiationOffer = $connection->fetchRow($select, $bind);

        return $negotiationOffer;
    }
}