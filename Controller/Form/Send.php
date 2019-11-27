<?php

namespace Mikielis\PriceNegotiation\Controller\Form;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Magento\Store\Model\StoreManagerInterface;
use Mikielis\PriceNegotiation\Api\NegotiationRepositoryInterface;
use Mikielis\PriceNegotiation\Service\Notification\Send as NotificationManager;
use Psr\Log\LoggerInterface;

class Send extends Action
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var MessageManager
     */
    protected $messageManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var NotificationManager
     */
    protected $notification;

    /**
     * @var NegotiationRepositoryInterface
     */
    protected $negotiationRepository;

    public function __construct(
        StoreManagerInterface $storeManager,
        MessageManager $messageManager,
        LoggerInterface $logger,
        NotificationManager $notification,
        NegotiationRepositoryInterface $negotiationRepository,
        Context $context
    ) {
        $this->storeManager = $storeManager;
        $this->negotiationRepository = $negotiationRepository;
        $this->messageManager = $messageManager;
        $this->logger = $logger;
        $this->notification = $notification;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $storeId = $this->storeManager->getStore()->getId();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        /** Save offer and notify client and admin */
        if ($data) {
            try {
                $this->negotiationRepository->save($storeId, $data);
                $this->messageManager->addSuccessMessage(__('Thank you! We have received your negotiation offer.'));
                $this->notification->notify($data);
                return $resultRedirect->setUrl($this->getRequest()->getParam('url'));
            } catch (\Exception $exception) {
                $this->logger->critical($exception->getMessage());
                throw new NotFoundException(__('Page not Found'));
            }
        } else {
            throw new NotFoundException(__('Page not Found'));
        }
    }
}
