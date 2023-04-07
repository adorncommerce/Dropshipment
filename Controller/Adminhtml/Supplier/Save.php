<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Controller\Adminhtml\Supplier;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context                   $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Excute Method
     *
     * @return Redirect
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('supplier_id');

            $model = $this->_objectManager->create(\Adorncommerce\Dropshipment\Model\Supplier::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Supplier no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            if (isset($data['general']['supplier_logo'])) {
                $data['general']['supplier_logo'] = $data['general']['supplier_logo'][0]['name'];
            } else {
                $data['general']['supplier_logo'] = "";
            }
            if (isset($data['general']) && isset($data['supplier_email_template_configuration'])) {
                $supplierData = array_merge($data['general'], $data['supplier_email_template_configuration']);
                if (isset($data['supplier_email_template_configuration'])) {
                    $supplierData['supplier_logo'] = $data['general']['supplier_logo'];
                }
                $supplierData['supplier_status'] = $data['general']['supplier_status'];
                $model->setData($supplierData);
            }
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Supplier.'));
                $this->dataPersistor->clear('adorncommerce_dropshipment_supplier');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['supplier_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->
                addExceptionMessage($e, __('Something went wrong while saving the Supplier.'));
            }

            $this->dataPersistor->set('adorncommerce_dropshipment_supplier', $supplierData);
            return $resultRedirect->setPath('*/*/edit', ['supplier_id' =>
                $this->getRequest()->getParam('supplier_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
