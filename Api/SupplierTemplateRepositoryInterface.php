<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SupplierTemplateRepositoryInterface
{

    /**
     * Save SupplierTemplate
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface $supplierTemplate
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface $supplierTemplate
    );

    /**
     * Retrieve SupplierTemplate
     *
     * @param string $suppliertemplateId
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($suppliertemplateId);

    /**
     * Retrieve SupplierTemplate matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SupplierTemplate
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface $supplierTemplate
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface $supplierTemplate
    );

    /**
     * Delete SupplierTemplate by ID
     *
     * @param string $suppliertemplateId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($suppliertemplateId);
}
