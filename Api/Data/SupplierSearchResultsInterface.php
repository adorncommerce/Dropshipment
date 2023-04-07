<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api\Data;

interface SupplierSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Supplier list.
     *
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierInterface[]
     */
    public function getItems();

    /**
     * Set supplier_code list.
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\SupplierInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
