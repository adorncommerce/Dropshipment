<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model;

use Adorncommerce\Dropshipment\Api\Data\SupplierInterface;
use Magento\Framework\Model\AbstractModel;

class Supplier extends AbstractModel implements SupplierInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Adorncommerce\Dropshipment\Model\ResourceModel\Supplier::class);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierId()
    {
        return $this->getData(self::SUPPLIER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierId($supplierId)
    {
        return $this->setData(self::SUPPLIER_ID, $supplierId);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierCode()
    {
        return $this->getData(self::SUPPLIER_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierCode($supplierCode)
    {
        return $this->setData(self::SUPPLIER_CODE, $supplierCode);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierLogo()
    {
        return $this->getData(self::SUPPLIER_LOGO);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierLogo($supplierLogo)
    {
        return $this->setData(self::SUPPLIER_LOGO, $supplierLogo);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierStatus()
    {
        return $this->getData(self::SUPPLIER_STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierStatus($supplierStatus)
    {
        return $this->setData(self::SUPPLIER_STATUS, $supplierStatus);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierEmail()
    {
        return $this->getData(self::SUPPLIER_EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierEmail($supplierEmail)
    {
        return $this->setData(self::SUPPLIER_EMAIL, $supplierEmail);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierCompany()
    {
        return $this->getData(self::SUPPLIER_COMPANY);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierCompany($supplierCompany)
    {
        return $this->setData(self::SUPPLIER_COMPANY, $supplierCompany);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierWebsite()
    {
        return $this->getData(self::SUPPLIER_WEBSITE);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierWebsite($supplierWebsite)
    {
        return $this->setData(self::SUPPLIER_WEBSITE, $supplierWebsite);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierSalesContactName()
    {
        return $this->getData(self::SUPPLIER_SALES_CONTACT_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierSalesContactName($supplierSalesContactName)
    {
        return $this->setData(self::SUPPLIER_SALES_CONTACT_NAME, $supplierSalesContactName);
    }

    /**
     * @inheritDoc
     */
    public function getSupllierSalesEmail()
    {
        return $this->getData(self::SUPLLIER_SALES_EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setSupllierSalesEmail($supllierSalesEmail)
    {
        return $this->setData(self::SUPLLIER_SALES_EMAIL, $supllierSalesEmail);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierSalesPhoneNumber()
    {
        return $this->getData(self::SUPPLIER_SALES_PHONE_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierSalesPhoneNumber($supplierSalesPhoneNumber)
    {
        return $this->setData(self::SUPPLIER_SALES_PHONE_NUMBER, $supplierSalesPhoneNumber);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierStreetAddress()
    {
        return $this->getData(self::SUPPLIER_STREET_ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierStreetAddress($supplierStreetAddress)
    {
        return $this->setData(self::SUPPLIER_STREET_ADDRESS, $supplierStreetAddress);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierCity()
    {
        return $this->getData(self::SUPPLIER_CITY);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierCity($supplierCity)
    {
        return $this->setData(self::SUPPLIER_CITY, $supplierCity);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierPostalCode()
    {
        return $this->getData(self::SUPPLIER_POSTAL_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierPostalCode($supplierPostalCode)
    {
        return $this->setData(self::SUPPLIER_POSTAL_CODE, $supplierPostalCode);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierCountry()
    {
        return $this->getData(self::SUPPLIER_COUNTRY);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierCountry($supplierCountry)
    {
        return $this->setData(self::SUPPLIER_COUNTRY, $supplierCountry);
    }

    /**
     * @inheritDoc
     */
    public function getEmailTemplate()
    {
        return $this->getData(self::EMAIL_TEMPLATE);
    }

    /**
     * @inheritDoc
     */
    public function setEmailTemplate($emailTemplate)
    {
        return $this->setData(self::EMAIL_TEMPLATE, $emailTemplate);
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
