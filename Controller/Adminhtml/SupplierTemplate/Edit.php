<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Controller\Adminhtml\SupplierTemplate;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Adorncommerce\Dropshipment\Controller\Adminhtml\SupplierTemplate
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('suppliertemplate_id');
        $model = $this->_objectManager->create(\Adorncommerce\Dropshipment\Model\SupplierTemplate::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Suppliertemplate no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('adorncommerce_dropshipment_suppliertemplate', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Suppliertemplate') : __('New Suppliertemplate'),
            $id ? __('Edit Suppliertemplate') : __('New Suppliertemplate')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Suppliertemplates'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ?
            __('Edit Suppliertemplate %1', $model->getId()) : __('New Suppliertemplate'));
        return $resultPage;
    }
}
