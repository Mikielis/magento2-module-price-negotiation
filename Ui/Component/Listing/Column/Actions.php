<?php

namespace Mikielis\PriceNegotiation\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Mikielis\PriceNegotiation\Api\Data\NegotiationInterface;

class Actions extends Column
{
    const URL_PATH_DELETE = 'mikielis_pricenegotiation/offers/delete';

    const URL_PATH_REJECT = 'mikielis_pricenegotiation/offers/reject';

    const URL_PATH_VIEW = 'mikielis_pricenegotiation/offers/view';

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['offer_id'])) {
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->getContext()->getUrl(
                                self::URL_PATH_VIEW,
                                [
                                    'id' => $item['offer_id']
                                ]
                            ),
                            'label' => __('View')
                        ],
                        'delete' => [
                            'href' => $this->getContext()->getUrl(
                                self::URL_PATH_DELETE,
                                [
                                    'id' => $item['offer_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete'),
                                'message' => __('Are you sure you want to delete this item?')
                            ]
                        ],
                        'reject' => [
                            'href' => $this->getContext()->getUrl(
                                self::URL_PATH_REJECT,
                                [
                                    'id' => $item['offer_id']
                                ]
                            ),
                            'label' => __('Reject'),
                            'confirm' => [
                                'title' => __('Reject'),
                                'message' => __('Are you sure you want to refuse?')
                            ]
                        ]
                    ];

                    /** The offer has been already rejected therefore there shouldn't be another reject option */
                    if ($item['status'] == NegotiationInterface::STATUS_REJECTED) {
                        unset($item[$this->getData('name')]['reject']);
                    }
                }
            }
        }

        return $dataSource;
    }
}