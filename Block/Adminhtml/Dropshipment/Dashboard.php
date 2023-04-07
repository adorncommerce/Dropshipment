<?php

/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Adorncommerce\Dropshipment\Block\Adminhtml\Dropshipment;

use Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment\Collection;
use Magento\Backend\Block\Template\Context;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\Registry;
use Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment\CollectionFactory as DropshipmentCollectionFactory;
use \Magento\Framework\Pricing\Helper\Data as PricingHelperData;

class Dashboard extends \Magento\Backend\Block\Template
{
    /**
     * Block template.
     *
     * @var string
     */
    protected $_template = 'Adorncommerce_Dropshipment::supplier/view/tab/dashboard.phtml';

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $_coreRegistry
     * @param DropshipmentCollectionFactory $dropshipmentCollectionFactory
     * @param PricingHelperData $pricingHelperData
     * @param array $data
     * @param JsonHelper|null $jsonHelper
     * @param DirectoryHelper|null $directoryHelper
     */
    public function __construct(
        Context                       $context,
        Registry                      $_coreRegistry,
        DropshipmentCollectionFactory $dropshipmentCollectionFactory,
        PricingHelperData $pricingHelperData,
        array                         $data = [],
        ?JsonHelper                   $jsonHelper = null,
        ?DirectoryHelper              $directoryHelper = null
    ) {
        $this->_coreRegistry = $_coreRegistry;
        $this->dropshipmentCollectionFactory = $dropshipmentCollectionFactory;
        $this->pricingHelperData = $pricingHelperData;
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
    }

    /**
     * Get Total Sales
     *
     * @return int|mixed
     */
    public function getTotalSales()
    {
        $model = $this->_coreRegistry->registry('adorncommerce_dropshipment_supplier');
        if ($model->getId()) {
            $salesCollection = $this->getDropshipmentCollection($model->getId());
            $total = 0;
            foreach ($salesCollection as $dropshipment) {
                if ($model->getId() === $dropshipment->getSupplierId()) {
                    $total += $dropshipment->getPrice() * $dropshipment->getQtyDropshipped() ?? $dropshipment->getQty();
                }
            }
            return $this->getPricing($total);
        }
        return $this->getPricing(0);
    }

    /**
     * Get Total Costs
     *
     * @return int|mixed
     */
    public function getTotalCosts()
    {
        $model = $this->_coreRegistry->registry('adorncommerce_dropshipment_supplier');
        if ($model->getId()) {
            $salesCollection = $this->getDropshipmentCollection($model->getId());
            $total = 0;
            foreach ($salesCollection as $dropshipment) {
                if ($model->getId() === $dropshipment->getSupplierId()) {
                    $total += $dropshipment->getCost() * $dropshipment->getQtyDropshipped() ?? $dropshipment->getQty();
                }
            }
            return $this->getPricing($total);
        }
        return $this->getPricing(0);
    }

    /**
     * Get No. Of Dropshipments
     *
     * @return int
     */
    public function getNoOfDropshipments()
    {
        $model = $this->_coreRegistry->registry('adorncommerce_dropshipment_supplier');
        if ($model->getId()) {
            $salesCollection = $this->getDropshipmentCollection($model->getId());
            $count = $salesCollection->count();
            return $this->getPricing($count);
        }
        return 0;
    }

    /**
     * Get Total Earnings
     *
     * @return int|mixed
     */
    public function getTotalEarnings()
    {
        $totalSales = (int)$this->getTotalSales();
        $totalCosts = (int)$this->getTotalCosts();
        $totalEarnings = $totalSales - $totalCosts;
        return $this->getPricing($totalEarnings);
    }

    /**
     * Get Dropshipment Collection
     *
     * @param mixed $supplierId
     * @return Collection
     */
    public function getDropshipmentCollection($supplierId)
    {
        return $this->dropshipmentCollectionFactory->create()->addFieldToSelect('*')
            ->addFieldToFilter('supplier_id', ['eq' => $supplierId]);
    }

    /**
     * Get Price
     *
     * @param mixed $price
     * @return float|string
     */
    public function getPricing($price)
    {
        return $this->pricingHelperData->currency($price, true, false);
    }
}
