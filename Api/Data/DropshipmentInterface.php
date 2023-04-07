<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Api\Data;

interface DropshipmentInterface
{

    public const ORDER_ID = 'order_id';
    public const ADDITIONAL_INFO = 'additional_info';
    public const SKU = 'sku';
    public const COST = 'cost';
    public const PRODUCT_NAME = 'product_name';
    public const SUPPLIER_ID = 'supplier_id';
    public const PRICE = 'price';
    public const ORDER_ITEM_ID = 'order_item_id';
    public const PRODUCT_ID = 'product_id';
    public const QTY = 'qty';
    public const SKU_DROPSHIPPED = 'sku_dropshipped';
    public const CREATED_AT = 'created_at';
    public const SUPPLIER_NAME = 'supplier_name';
    public const QTY_DROPSHIPPED = 'qty_dropshipped';
    public const DROPSHIPMENT_ID = 'dropshipment_id';

    /**
     * Get dropshipment_id
     *
     * @return string|null
     */
    public function getDropshipmentId();

    /**
     * Set dropshipment_id
     *
     * @param string $dropshipmentId
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setDropshipmentId($dropshipmentId);

    /**
     * Get order_id
     *
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     *
     * @param string $orderId
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setOrderId($orderId);

    /**
     * Get order_item_id
     *
     * @return string|null
     */
    public function getOrderItemId();

    /**
     * Set order_item_id
     *
     * @param string $orderItemId
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setOrderItemId($orderItemId);

    /**
     * Get supplier_id
     *
     * @return string|null
     */
    public function getSupplierId();

    /**
     * Set supplier_id
     *
     * @param string $supplierId
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setSupplierId($supplierId);

    /**
     * Get supplier_name
     *
     * @return string|null
     */
    public function getSupplierName();

    /**
     * Set supplier_name
     *
     * @param string $supplierName
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setSupplierName($supplierName);

    /**
     * Get product_id
     *
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     *
     * @param string $productId
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setProductId($productId);

    /**
     * Get product_name
     *
     * @return string|null
     */
    public function getProductName();

    /**
     * Set product_name
     *
     * @param string $productName
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setProductName($productName);

    /**
     * Get additional_info
     *
     * @return string|null
     */
    public function getAdditionalInfo();

    /**
     * Set additional_info
     *
     * @param string $additionalInfo
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setAdditionalInfo($additionalInfo);

    /**
     * Get sku
     *
     * @return string|null
     */
    public function getSku();

    /**
     * Set sku
     *
     * @param string $sku
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setSku($sku);

    /**
     * Get sku_dropshipped
     *
     * @return string|null
     */
    public function getSkuDropshipped();

    /**
     * Set sku_dropshipped
     *
     * @param string $skuDropshipped
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setSkuDropshipped($skuDropshipped);

    /**
     * Get qty
     *
     * @return string|null
     */
    public function getQty();

    /**
     * Set qty
     *
     * @param string $qty
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setQty($qty);

    /**
     * Get qty_dropshipped
     *
     * @return string|null
     */
    public function getQtyDropshipped();

    /**
     * Set qty_dropshipped
     *
     * @param string $qtyDropshipped
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setQtyDropshipped($qtyDropshipped);

    /**
     * Get cost
     *
     * @return string|null
     */
    public function getCost();

    /**
     * Set cost
     *
     * @param string $cost
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setCost($cost);

    /**
     * Get price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set price
     *
     * @param string $price
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setPrice($price);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $createdAt
     * @return \Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface
     */
    public function setCreatedAt($createdAt);
}
