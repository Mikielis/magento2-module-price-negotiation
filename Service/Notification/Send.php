<?php

namespace Mikielis\PriceNegotiation\Service\Notification;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Area;
use Magento\Store\Model\ScopeInterface;

class Send extends AbstractHelper
{
    /**
     * Template of customer email
     */
    const CONFIG_PATH_EMAIL_TEMPLATE_FIELD = 'mikielis_negotiation/content/customer_email/template';

    /**
     * Sender email config path - from default CONTACT extension
     */
    const CONFIG_PATH_EMAIL_SENDER = 'trans_email/ident_general/email';

    /**
     * Sender name config path - from default CONTACT extension
     */
    const CONFIG_PATH_NAME_SENDER = 'trans_email/ident_general/name';

    /**
     * Subject of customer email
     */
    const CONFIG_PATH_CUSTOMER_EMAIL_SUBJECT = 'mikielis_negotiation/content/customer_email/subject';

    /**
     * Message of customer email
     */
    const CONFIG_PATH_CUSTOMER_EMAIL_MESSAGE = 'mikielis_negotiation/content/customer_email/message';

    /**
     * Subject of admin email
     */
    const CONFIG_PATH_ADMIN_EMAIL_SUBJECT = 'mikielis_negotiation/content/admin_email/subject';

    /**
     * Message of admin email
     */
    const CONFIG_PATH_ADMIN_EMAIL_MESSAGE = 'mikielis_negotiation/content/admin_email/message';

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var use StateInterface
     */
    private $inlineTranslation;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     *
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param StateInterface $inlineTranslation
     * @param TransportBuilder $transportBuilder
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
    }

    /**
     * Return store configuration value of template field
     *
     * @param string $path
     * @param int $storeId
     * @return mixed
     */
    private function getConfigValue($path, $storeId)
    {
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Return store
     * @return StoreInterface
     * @throws NoSuchEntityException
     */
    public function getStore()
    {
        return $this->storeManager->getStore();
    }

    /**
     * @param $variable
     * @param $receiverInfo
     * @param $sender
     * @param $templateId
     * @return $this
     * @throws NoSuchEntityException
     * @throws MailException
     */
    public function generateEmail($variable, $receiverInfo, $sender, $templateId)
    {
        $this->transportBuilder->setTemplateIdentifier($templateId)
            ->setTemplateOptions(
                [
                    'area' => Area::AREA_FRONTEND,
                    'store' => $this->storeManager->getStore()->getId(),
                ]
            )
            ->setTemplateVars($variable)
            ->setFromByScope($sender, ScopeInterface::SCOPE_STORE)
            ->addTo($receiverInfo['email'], $receiverInfo['name']);

        return $this;
    }

    /**
     * Send email notification
     *
     * @param array $data
     * @return $this
     * @throws LocalizedException
     * @throws MailException
     * @throws NoSuchEntityException
     */
    public function notify($data)
    {
        /**
         * Customer email
         */

        /** Receiver */
        $receiverInfo = [
            'name' => $data['name'],
            'email' => $data['email']
        ];

        /** Sender */
        $sender = [
            'name' => $this->scopeConfig->getValue(self::CONFIG_PATH_NAME_SENDER, ScopeInterface::SCOPE_STORE),
            'email' => $this->scopeConfig->getValue(self::CONFIG_PATH_EMAIL_SENDER, ScopeInterface::SCOPE_STORE)
        ];

        /* Assign values for your template variables  */
        $variables = [];
        $variables['email_text'] = $this->getConfigValue(self::CONFIG_PATH_CUSTOMER_EMAIL_MESSAGE, $this->getStore()->getStoreId());
        $variables['subject'] = $this->getConfigValue(self::CONFIG_PATH_CUSTOMER_EMAIL_SUBJECT, $this->getStore()->getStoreId());
        $templateId = $this->getConfigValue(self::CONFIG_PATH_EMAIL_TEMPLATE_FIELD, $this->getStore()->getStoreId());
        $this->inlineTranslation->suspend();

        $this->generateEmail($variables, $receiverInfo, $sender, $templateId);
        $transport = $this->transportBuilder->getTransport();
        $transport->sendMessage();

        /**
         * Admin email
         */

        /** Receiver */
        $receiverInfo = [
            'name' => $this->scopeConfig->getValue(self::CONFIG_PATH_NAME_SENDER, ScopeInterface::SCOPE_STORE),
            'email' => $this->scopeConfig->getValue(self::CONFIG_PATH_EMAIL_SENDER, ScopeInterface::SCOPE_STORE)
        ];

        /** Sender */
        $sender = [
            'name' => $data['name'],
            'email' => $data['email']
        ];

        $variables = [];
        $variables['email_text'] = $this->getConfigValue(self::CONFIG_PATH_ADMIN_EMAIL_MESSAGE, $this->getStore()->getStoreId());
        $variables['subject'] = $this->getConfigValue(self::CONFIG_PATH_ADMIN_EMAIL_SUBJECT, $this->getStore()->getStoreId());
        $variables['currency'] = $this->storeManager->getStore()->getCurrentCurrency()->getCode();
        $variables = array_merge($variables, $data);

        $this->generateEmail($variables, $receiverInfo, $sender, $templateId);
        $transport = $this->transportBuilder->getTransport();
        $transport->sendMessage();

        $this->inlineTranslation->resume();

        return $this;
    }
}