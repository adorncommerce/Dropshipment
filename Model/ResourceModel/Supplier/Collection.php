<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model\ResourceModel\Supplier;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'supplier_id';

    /**
     * Construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Adorncommerce\Dropshipment\Model\Supplier::class,
            \Adorncommerce\Dropshipment\Model\ResourceModel\Supplier::class
        );
    }
}
