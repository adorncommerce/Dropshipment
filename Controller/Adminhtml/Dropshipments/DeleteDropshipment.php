<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Adorncommerce\Dropshipment\Controller\Adminhtml\Dropshipments;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\OrderItemRepositoryInterface;
use Adorncommerce\Dropshipment\Api\DropshipmentRepositoryInterface;
use Adorncommerce\Dropshipment\Model\DropshipmentFactory;

class DeleteDropshipment extends \Magento\Backend\App\Action
{
    /**
     * @var OrderItemRepositoryInterface
     */
    private $orderItemRepository;

    /**
     * @var DropshipmentRepositoryInterface
     */
    private $dropshipmentRepository;

    /**
     * @var DropshipmentFactory
     */
    private $dropshipmentFactory;

    /**
     * @param Context $context
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param DropshipmentRepositoryInterface $dropshipmentRepository
     * @param DropshipmentFactory $dropshipmentFactory
     */
    public function __construct(
        Context                         $context,
        OrderItemRepositoryInterface    $orderItemRepository,
        DropshipmentRepositoryInterface $dropshipmentRepository,
        DropshipmentFactory             $dropshipmentFactory
    ) {
        $this->orderItemRepository = $orderItemRepository;
        $this->dropshipmentRepository = $dropshipmentRepository;
        $this->dropshipmentFactory = $dropshipmentFactory;
        parent::__construct($context);
    }

    /**
     * Exexute Method
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost()) {
            try {
                foreach ($data['dropped_items'] as $orderItemId => $dropshipmentId) {
                    if ($dropshipmentId != null) {
                        $item = $this->orderItemRepository->get($orderItemId);
                        if ($item) {
                            $item->setIsDropshipGenerated(0);
                            $item->save();
                        }
                        $this->deleteDropshipment($dropshipmentId);
                    }
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $this->_redirect('sales/order/view/order_id/' . $this->getRequest()->getParam('id'));
            }
        } else {
            $this->messageManager->addErrorMessage('No dropshipped items were selected to be deleted.');
            return $this->_redirect('sales/order/view/order_id/' . $this->getRequest()->getParam('id'));
        }
        return $this->_redirect('sales/order/view/order_id/' . $this->getRequest()->getParam('id'));
    }

    /**
     * Delete Dropshipment
     *
     * @param mixed $dropshipmentId
     * @return void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteDropshipment($dropshipmentId)
    {
        if (!empty($dropshipmentId)) {
            $this->dropshipmentRepository->deleteById($dropshipmentId);
        }
    }
}
