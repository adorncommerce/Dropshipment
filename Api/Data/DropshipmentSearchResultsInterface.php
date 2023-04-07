<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api\Data;

interface DropshipmentSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Dropshipment list.
     *
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface[]
     */
    public function getItems();

    /**
     * Set order_id list.
     *
     * @param \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
