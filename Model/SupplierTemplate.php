<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model;

use Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface;
use Magento\Framework\Model\AbstractModel;

class SupplierTemplate extends AbstractModel implements SupplierTemplateInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Adorncommerce\Dropshipment\Model\ResourceModel\SupplierTemplate::class);
    }

    /**
     * @inheritDoc
     */
    public function getSuppliertemplateId()
    {
        return $this->getData(self::SUPPLIERTEMPLATE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSuppliertemplateId($suppliertemplateId)
    {
        return $this->setData(self::SUPPLIERTEMPLATE_ID, $suppliertemplateId);
    }

    /**
     * @inheritDoc
     */
    public function getEmailTemplateName()
    {
        return $this->getData(self::EMAIL_TEMPLATE_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setEmailTemplateName($emailTemplateName)
    {
        return $this->setData(self::EMAIL_TEMPLATE_NAME, $emailTemplateName);
    }

    /**
     * @inheritDoc
     */
    public function getEmailSubject()
    {
        return $this->getData(self::EMAIL_SUBJECT);
    }

    /**
     * @inheritDoc
     */
    public function setEmailSubject($emailSubject)
    {
        return $this->setData(self::EMAIL_SUBJECT, $emailSubject);
    }
    /**
     * @inheritDoc
     */
    public function getEmailHeader()
    {
        return $this->getData(self::EMAIL_HEADER);
    }

    /**
     * @inheritDoc
     */
    public function setEmailHeader($emailHeader)
    {
        return $this->setData(self::EMAIL_HEADER, $emailHeader);
    }

    /**
     * @inheritDoc
     */
    public function getEmailMessage()
    {
        return $this->getData(self::EMAIL_MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setEmailMessage($emailMessage)
    {
        return $this->setData(self::EMAIL_MESSAGE, $emailMessage);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
