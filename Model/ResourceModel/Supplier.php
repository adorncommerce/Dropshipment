<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Supplier extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('adorncommerce_dropshipment_supplier', 'supplier_id');
    }
}
