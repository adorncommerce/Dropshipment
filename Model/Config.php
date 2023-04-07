<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Adorncommerce\Dropshipment\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    public const XML_PATH_MODULE_ENABLED = 'dropshipment/general/enabled';
    public const XML_PATH_EMAIL_SUBJECT = 'dropshipment/email_option/email_subject';
    public const XML_PATH_EMAIL_HEADER = 'dropshipment/email_option/email_header';
    public const XML_PATH_EMAIL_SENDER_EMAIL = 'dropshipment/email_option/email_sender_email';
    public const XML_PATH_BCC_EMAIL_ADDRESS = 'dropshipment/email_option/bcc_email_address';
    public const XML_PATH_EMAIL_MESSAGE = 'dropshipment/email_option/email_message';
    public const XML_PATH_DROPSHIPMENT_PREFIX = 'dropshipment/dropshipment/dropshipment_prefix';
    public const XML_PATH_IS_SEND_PDF_IN_EMAIL = 'dropshipment/dropshipment/is_send_pdf_in_email';
    public const XML_PATH_ORDER_STATUS = 'dropshipment/dropshipment/order_status';
    public const XML_PATH_IS_ORDER_STATUS_CHANGE = 'dropshipment/dropshipment/is_order_status_change';

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Is Module Enabled
     *
     * @return mixed
     */
    public function isModuleEnabled()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_MODULE_ENABLED, $storeScope);
    }

    /**
     * Get Order Status
     *
     * @return mixed
     */
    public function getOrderStatus()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_ORDER_STATUS, $storeScope);
    }

    /**
     * Get Email Subject
     *
     * @return mixed
     */
    public function getEmailSubject()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_EMAIL_SUBJECT, $storeScope);
    }

    /**
     * Get Email Header
     *
     * @return mixed
     */
    public function getEmailHeader()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_EMAIL_HEADER, $storeScope);
    }

    /**
     * Get Email Sender Email
     *
     * @return mixed
     */
    public function getEmailSenderEmail()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER_EMAIL, $storeScope);
    }

    /**
     * Get BCC Email Address
     *
     * @return mixed
     */
    public function getBccEmailAddress()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_BCC_EMAIL_ADDRESS, $storeScope);
    }

    /**
     * Get Email Message
     *
     * @return mixed
     */
    public function getEmailMessage()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_EMAIL_MESSAGE, $storeScope);
    }

    /**
     * Get Dropshipment Prefix
     *
     * @return mixed
     */
    public function getDropshipmentPrefix()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_DROPSHIPMENT_PREFIX, $storeScope);
    }

    /**
     * Is Order Status Change
     *
     * @return mixed
     */
    public function getIsOrderStatusChange()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_IS_ORDER_STATUS_CHANGE, $storeScope);
    }

    /**
     * Is PDF Send in Email ?
     *
     * @return mixed
     */
    public function getIsPdfSendInEmail()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_IS_SEND_PDF_IN_EMAIL, $storeScope);
    }
}
