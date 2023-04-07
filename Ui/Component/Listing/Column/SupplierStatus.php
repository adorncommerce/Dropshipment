<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Ui\Component\Listing\Column;

class SupplierStatus implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Option Array
     *
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Disable')],
            ['value' => 1, 'label' => __('Enable')]
        ];
    }
}
