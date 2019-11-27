<?php

namespace Mikielis\PriceNegotiation\Controller\Adminhtml\Offers;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Mikielis\PriceNegotiation\Api\NegotiationRepositoryInterface;

class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mikielis_PriceNegotiation::offers';

    /**
     * @var ResultFactory
     */
    protected $resulFactory;

    /**
     * @var NegotiationRepositoryInterface
     */
    protected $negotiationRepository;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @param Context $context
     * @param ResultFactory $resultFactory
     * @param NegotiationRepositoryInterface $negotiationRepository
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        NegotiationRepositoryInterface $negotiationRepository,
        ManagerInterface $messageManager
    ) {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
        $this->negotiationRepository = $negotiationRepository;
        $this->messageManager = $messageManager;
    }

    /**
     * Execute action based on request and return result
     */
    public function execute()
    {
        $number = $this->negotiationRepository->massDelete($this->getRequest()->getParam('selected'));
        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been deleted.', $number)
        );

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('mikielis_pricenegotiation/offers/index');
    }
}
