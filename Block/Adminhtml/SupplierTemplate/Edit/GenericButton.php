<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Block\Adminhtml\SupplierTemplate\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Return model ID
     *
     * @return int|null
     */
    public function getModelId()
    {
        return $this->context->getRequest()->getParam('suppliertemplate_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
