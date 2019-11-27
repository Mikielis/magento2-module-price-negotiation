<?php

namespace Mikielis\PriceNegotiation\Controller\Adminhtml\Offers;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Mikielis\PriceNegotiation\Api\NegotiationRepositoryInterface;

class Delete extends Action implements HttpGetActionInterface
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
    protected $resultFactory;

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
        $id = $this->getRequest()->getParam('id');
        $this->negotiationRepository->delete($id);
        $this->messageManager->addSuccessMessage(
            __('The offer ID #%1 has been deleted.', $id)
        );

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('mikielis_pricenegotiation/offers/index');
    }
}
