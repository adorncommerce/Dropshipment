<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Controller\Adminhtml;

use Magento\Framework\Registry;

abstract class Supplier extends \Magento\Backend\App\Action
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;
    public const ADMIN_RESOURCE = 'Adorncommerce_Dropshipment::top_level';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Adorncommerce'), __('Adorncommerce'))
            ->addBreadcrumb(__('Supplier'), __('Supplier'));
        return $resultPage;
    }
}
