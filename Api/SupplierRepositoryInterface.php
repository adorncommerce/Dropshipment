<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SupplierRepositoryInterface
{

    /**
     * Save Supplier
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\SupplierInterface $supplier
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Adorncommerce\Dropshipment\Api\Data\SupplierInterface $supplier
    );

    /**
     * Retrieve Supplier
     *
     * @param string $supplierId
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($supplierId);

    /**
     * Retrieve Supplier matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Supplier
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\SupplierInterface $supplier
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Adorncommerce\Dropshipment\Api\Data\SupplierInterface $supplier
    );

    /**
     * Delete Supplier by ID
     *
     * @param string $supplierId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($supplierId);
}
