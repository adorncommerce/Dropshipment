<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api\Data;

interface SupplierTemplateInterface
{
    public const SUPPLIERTEMPLATE_ID = 'suppliertemplate_id';
    public const EMAIL_TEMPLATE_NAME = 'email_template_name';
    public const EMAIL_HEADER = 'email_header';
    public const EMAIL_SUBJECT = 'email_subject';
    public const EMAIL_MESSAGE = 'email_message';

    public const CREATED_AT = 'created_at';

    /**
     * Get suppliertemplate_id
     *
     * @return string|null
     */
    public function getSuppliertemplateId();

    /**
     * Set suppliertemplate_id
     *
     * @param string $suppliertemplateId
     * @return \Adorncommerce\Dropshipment\SupplierTemplate\Api\Data\SupplierTemplateInterface
     */
    public function setSuppliertemplateId($suppliertemplateId);

    /**
     * Set email_template_name
     *
     * @param string $emailTemplateName
     * @return \Adorncommerce\Dropshipment\SupplierTemplate\Api\Data\SupplierTemplateInterface
     */
    public function setEmailTemplateName($emailTemplateName);

    /**
     * Get email_template_name
     *
     * @return string|null
     */
    public function getEmailTemplateName();

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
     * @return \Adorncommerce\Dropshipment\SupplierTemplate\Api\Data\SupplierTemplateInterface
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
     * @return \Adorncommerce\Dropshipment\SupplierTemplate\Api\Data\SupplierTemplateInterface
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
     * @return \Adorncommerce\Dropshipment\SupplierTemplate\Api\Data\SupplierTemplateInterface
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
     * @return \Adorncommerce\Dropshipment\SupplierTemplate\Api\Data\SupplierTemplateInterface
     */
    public function setCreatedAt($createdAt);
}
