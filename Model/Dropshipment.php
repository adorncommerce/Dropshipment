<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model;

use Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface;
use Magento\Framework\Model\AbstractModel;

class Dropshipment extends AbstractModel implements DropshipmentInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment::class);
    }

    /**
     * @inheritDoc
     */
    public function getDropshipmentId()
    {
        return $this->getData(self::DROPSHIPMENT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setDropshipmentId($dropshipmentId)
    {
        return $this->setData(self::DROPSHIPMENT_ID, $dropshipmentId);
    }

    /**
     * @inheritDoc
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @inheritDoc
     */
    public function getOrderItemId()
    {
        return $this->getData(self::ORDER_ITEM_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderItemId($orderItemId)
    {
        return $this->setData(self::ORDER_ITEM_ID, $orderItemId);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierId()
    {
        return $this->getData(self::SUPPLIER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierId($supplierId)
    {
        return $this->setData(self::SUPPLIER_ID, $supplierId);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierName()
    {
        return $this->getData(self::SUPPLIER_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setSupplierName($supplierName)
    {
        return $this->setData(self::SUPPLIER_NAME, $supplierName);
    }

    /**
     * @inheritDoc
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @inheritDoc
     */
    public function getProductName()
    {
        return $this->getData(self::PRODUCT_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setProductName($productName)
    {
        return $this->setData(self::PRODUCT_NAME, $productName);
    }

    /**
     * @inheritDoc
     */
    public function getAdditionalInfo()
    {
        return $this->getData(self::ADDITIONAL_INFO);
    }

    /**
     * @inheritDoc
     */
    public function setAdditionalInfo($additionalInfo)
    {
        return $this->setData(self::ADDITIONAL_INFO, $additionalInfo);
    }

    /**
     * @inheritDoc
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * @inheritDoc
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * @inheritDoc
     */
    public function getSkuDropshipped()
    {
        return $this->getData(self::SKU_DROPSHIPPED);
    }

    /**
     * @inheritDoc
     */
    public function setSkuDropshipped($skuDropshipped)
    {
        return $this->setData(self::SKU_DROPSHIPPED, $skuDropshipped);
    }

    /**
     * @inheritDoc
     */
    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    /**
     * @inheritDoc
     */
    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * @inheritDoc
     */
    public function getQtyDropshipped()
    {
        return $this->getData(self::QTY_DROPSHIPPED);
    }

    /**
     * @inheritDoc
     */
    public function setQtyDropshipped($qtyDropshipped)
    {
        return $this->setData(self::QTY_DROPSHIPPED, $qtyDropshipped);
    }

    /**
     * @inheritDoc
     */
    public function getCost()
    {
        return $this->getData(self::COST);
    }

    /**
     * @inheritDoc
     */
    public function setCost($cost)
    {
        return $this->setData(self::COST, $cost);
    }

    /**
     * @inheritDoc
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
