<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface DropshipmentRepositoryInterface
{

    /**
     * Save Dropshipment
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface $dropshipment
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface $dropshipment
    );

    /**
     * Retrieve Dropshipment
     *
     * @param string $dropshipmentId
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($dropshipmentId);

    /**
     * Retrieve Dropshipment matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Dropshipment
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface $dropshipment
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface $dropshipment
    );

    /**
     * Delete Dropshipment by ID
     *
     * @param string $dropshipmentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($dropshipmentId);
}
