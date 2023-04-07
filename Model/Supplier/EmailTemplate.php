<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Adorncommerce\Dropshipment\Model\Supplier;

use Magento\Framework\Option\ArrayInterface;
use Adorncommerce\Dropshipment\Model\ResourceModel\SupplierTemplate\CollectionFactory as
    SupplierTemplateCollectionFactory;

class EmailTemplate implements ArrayInterface
{
    /**
     * @param SupplierTemplateCollectionFactory $supplierTemplateCollectionFactory
     */
    public function __construct(SupplierTemplateCollectionFactory $supplierTemplateCollectionFactory)
    {
        $this->supplierTemplateCollectionFactory = $supplierTemplateCollectionFactory;
    }

    /**
     * To Option Array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $templateCollection = $this->supplierTemplateCollectionFactory->create();
        $options = [];
        $options[] = [
            'value' => 0,
            'label' => "Custom Template"
        ];
        foreach ($templateCollection as $template) {
            $options[] = [
                'value' => (int)$template->getSuppliertemplateId(),
                'label' => $template->getEmailTemplateName()
            ];
        }
        return $options;
    }
}
