<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api\Data;

interface SupplierInterface
{

    public const SUPPLIER_STATUS = 'supplier_status';
    public const SUPPLIER_COMPANY = 'supplier_company';
    public const SUPPLIER_SALES_CONTACT_NAME = 'supplier_sales_contact_name';
    public const SUPPLIER_WEBSITE = 'supplier_website';
    public const SUPPLIER_COUNTRY = 'supplier_country';
    public const CREATED_AT = 'created_at';
    public const SUPPLIER_LOGO = 'supplier_logo';
    public const EMAIL_HEADER = 'email_header';
    public const SUPPLIER_CODE = 'supplier_code';
    public const SUPPLIER_ID = 'supplier_id';
    public const EMAIL_MESSAGE = 'email_message';
    public const SUPPLIER_POSTAL_CODE = 'supplier_postal_code';
    public const SUPPLIER_SALES_PHONE_NUMBER = 'supplier_sales_phone_number';
    public const EMAIL_TEMPLATE = 'email_template';
    public const SUPPLIER_EMAIL = 'supplier_email';
    public const SUPLLIER_SALES_EMAIL = 'supllier_sales_email';
    public const EMAIL_SUBJECT = 'email_subject';
    public const SUPPLIER_STREET_ADDRESS = 'supplier_street_address';
    public const SUPPLIER_CITY = 'supplier_city';

    /**
     * Get supplier_id
     *
     * @return string|null
     */
    public function getSupplierId();

    /**
     * Set supplier_id
     *
     * @param string $supplierId
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierId($supplierId);

    /**
     * Get supplier_code
     *
     * @return string|null
     */
    public function getSupplierCode();

    /**
     * Set supplier_code
     *
     * @param string $supplierCode
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierCode($supplierCode);

    /**
     * Get supplier_logo
     *
     * @return string|null
     */
    public function getSupplierLogo();

    /**
     * Set supplier_logo
     *
     * @param string $supplierLogo
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierLogo($supplierLogo);

    /**
     * Get supplier_status
     *
     * @return string|null
     */
    public function getSupplierStatus();

    /**
     * Set supplier_status
     *
     * @param string $supplierStatus
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierStatus($supplierStatus);

    /**
     * Get supplier_email
     *
     * @return string|null
     */
    public function getSupplierEmail();

    /**
     * Set supplier_email
     *
     * @param string $supplierEmail
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierEmail($supplierEmail);

    /**
     * Get supplier_company
     *
     * @return string|null
     */
    public function getSupplierCompany();

    /**
     * Set supplier_company
     *
     * @param string $supplierCompany
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierCompany($supplierCompany);

    /**
     * Get supplier_website
     *
     * @return string|null
     */
    public function getSupplierWebsite();

    /**
     * Set supplier_website
     *
     * @param string $supplierWebsite
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierWebsite($supplierWebsite);

    /**
     * Get supplier_sales_contact_name
     *
     * @return string|null
     */
    public function getSupplierSalesContactName();

    /**
     * Set supplier_sales_contact_name
     *
     * @param string $supplierSalesContactName
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierSalesContactName($supplierSalesContactName);

    /**
     * Get supllier_sales_email
     *
     * @return string|null
     */
    public function getSupllierSalesEmail();

    /**
     * Set supllier_sales_email
     *
     * @param string $supllierSalesEmail
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupllierSalesEmail($supllierSalesEmail);

    /**
     * Get supplier_sales_phone_number
     *
     * @return string|null
     */
    public function getSupplierSalesPhoneNumber();

    /**
     * Set supplier_sales_phone_number
     *
     * @param string $supplierSalesPhoneNumber
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierSalesPhoneNumber($supplierSalesPhoneNumber);

    /**
     * Get supplier_street_address
     *
     * @return string|null
     */
    public function getSupplierStreetAddress();

    /**
     * Set supplier_street_address
     *
     * @param string $supplierStreetAddress
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierStreetAddress($supplierStreetAddress);

    /**
     * Get supplier_city
     *
     * @return string|null
     */
    public function getSupplierCity();

    /**
     * Set supplier_city
     *
     * @param string $supplierCity
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierCity($supplierCity);

    /**
     * Get supplier_postal_code
     *
     * @return string|null
     */
    public function getSupplierPostalCode();

    /**
     * Set supplier_postal_code
     *
     * @param string $supplierPostalCode
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierPostalCode($supplierPostalCode);

    /**
     * Get supplier_country
     *
     * @return string|null
     */
    public function getSupplierCountry();

    /**
     * Set supplier_country
     *
     * @param string $supplierCountry
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setSupplierCountry($supplierCountry);

    /**
     * Get email_template
     *
     * @return string|null
     */
    public function getEmailTemplate();

    /**
     * Set email_template
     *
     * @param string $emailTemplate
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setEmailTemplate($emailTemplate);

    /**
     * Get email_subject
     *
     * @return string|null
     */
    public function getEmailSubject();

    /**
     * Set email_subject
     *
     * @param string $emailSubject
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setEmailSubject($emailSubject);

    /**
     * Get email_header
     *
     * @return string|null
     */
    public function getEmailHeader();

    /**
     * Set email_header
     *
     * @param string $emailHeader
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setEmailHeader($emailHeader);

    /**
     * Get email_message
     *
     * @return string|null
     */
    public function getEmailMessage();

    /**
     * Set email_message
     *
     * @param string $emailMessage
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setEmailMessage($emailMessage);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $createdAt
     * @return \Adorncommerce\Dropshipment\Supplier\Api\Data\SupplierInterface
     */
    public function setCreatedAt($createdAt);
}
