<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api\Data;

interface SupplierTemplateSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get SupplierTemplate list.
     *
     * @return \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface[]
     */
    public function getItems();

    /**
     * Set email_template list.
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
