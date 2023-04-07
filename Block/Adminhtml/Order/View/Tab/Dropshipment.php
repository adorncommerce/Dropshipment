<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Adorncommerce\Dropshipment\Block\Adminhtml\Order\View\Tab;

use Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment\Collection;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Sales\Model\Order;
use Magento\Catalog\Model\ProductFactory;
use Adorncommerce\Dropshipment\Model\ResourceModel\Supplier\CollectionFactory as SupplierCollectionFactory;
use Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment\CollectionFactory as DropshipmentCollectionFactory;
use Adorncommerce\Dropshipment\Model\Config;

class Dropshipment extends \Magento\Backend\Block\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var string
     */
    protected $_template = 'Adorncommerce_Dropshipment::order/view/tab/dropshipment.phtml';

    /**
     * @var Registry
     */
    private $_coreRegistry;

    /**
     * @var ProductFactory
     */
    private $productFactory;
    /**
     * @var SupplierCollectionFactory
     */
    private $supplierCollectionFactory;
    /**
     * @var DropshipmentCollectionFactory
     */
    private $dropshipmentCollectionFactory;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param ProductFactory $productFactory
     * @param SupplierCollectionFactory $supplierCollectionFactory
     * @param DropshipmentCollectionFactory $dropshipmentCollectionFactory
     * @param Config $config
     * @param array $data
     */
    public function __construct(
        Context         $context,
        Registry        $registry,
        ProductFactory  $productFactory,
        SupplierCollectionFactory $supplierCollectionFactory,
        DropshipmentCollectionFactory $dropshipmentCollectionFactory,
        Config $config,
        array           $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->productFactory = $productFactory;
        $this->supplierCollectionFactory = $supplierCollectionFactory;
        $this->dropshipmentCollectionFactory = $dropshipmentCollectionFactory;
        $this->config = $config;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve order model instance
     *
     * @return Order
     */
    public function getOrder()
    {
        return $this->_coreRegistry->registry('current_order');
    }

    /**
     * Get Product
     *
     * @param mixed $id
     * @return mixed
     */
    public function getProduct($id)
    {
        return $this->productFactory->create()->load($id);
    }

    /**
     * Get All Suppliers
     *
     * @return mixed
     */
    public function getAllSuppliers()
    {
        $suppliers = $this->supplierCollectionFactory->create()
            ->setOrder('supplier_code', 'ASC')
            ->addFieldToFilter('supplier_status', ['eq' => 1]);
        return $suppliers;
    }

    /**
     * Get Generated Dropshipment Items
     *
     * @param mixed $orderId
     * @return Collection
     */
    public function getDropshipmentGeneratedItems($orderId)
    {
        $suppliers = $this->dropshipmentCollectionFactory->create()
            ->addFieldToFilter('order_id', ['eq' => $orderId]);
        return $suppliers;
    }

    /**
     * Tab Label
     *
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Dropshipment');
    }

    /**
     * Get Tab Title
     *
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Dropshipment');
    }

    /**
     * Show Tab
     *
     * @return bool
     */
    public function canShowTab()
    {
        if ($this->config->isModuleEnabled()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Is Hidden
     *
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
