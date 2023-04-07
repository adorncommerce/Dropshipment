<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model;

use Adorncommerce\Dropshipment\Api\Data\SupplierInterface;
use Adorncommerce\Dropshipment\Api\Data\SupplierInterfaceFactory;
use Adorncommerce\Dropshipment\Api\Data\SupplierSearchResultsInterfaceFactory;
use Adorncommerce\Dropshipment\Api\SupplierRepositoryInterface;
use Adorncommerce\Dropshipment\Model\ResourceModel\Supplier as ResourceSupplier;
use Adorncommerce\Dropshipment\Model\ResourceModel\Supplier\CollectionFactory as SupplierCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class SupplierRepository implements SupplierRepositoryInterface
{

    /**
     * @var SupplierInterfaceFactory
     */
    protected $supplierFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ResourceSupplier
     */
    protected $resource;

    /**
     * @var SupplierCollectionFactory
     */
    protected $supplierCollectionFactory;

    /**
     * @var Supplier
     */
    protected $searchResultsFactory;

    /**
     * @param ResourceSupplier $resource
     * @param SupplierInterfaceFactory $supplierFactory
     * @param SupplierCollectionFactory $supplierCollectionFactory
     * @param SupplierSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSupplier $resource,
        SupplierInterfaceFactory $supplierFactory,
        SupplierCollectionFactory $supplierCollectionFactory,
        SupplierSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->supplierFactory = $supplierFactory;
        $this->supplierCollectionFactory = $supplierCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save
     *
     * @param SupplierInterface $supplier
     * @return SupplierInterface
     * @throws CouldNotSaveException
     */
    public function save(SupplierInterface $supplier)
    {
        try {
            $this->resource->save($supplier);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the supplier: %1',
                $exception->getMessage()
            ));
        }
        return $supplier;
    }

    /**
     * @inheritDoc
     */
    public function get($supplierId)
    {
        $supplier = $this->supplierFactory->create();
        $this->resource->load($supplier, $supplierId);
        if (!$supplier->getId()) {
            throw new NoSuchEntityException(__('Supplier with id "%1" does not exist.', $supplierId));
        }
        return $supplier;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->supplierCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(SupplierInterface $supplier)
    {
        try {
            $supplierModel = $this->supplierFactory->create();
            $this->resource->load($supplierModel, $supplier->getSupplierId());
            $this->resource->delete($supplierModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Supplier: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($supplierId)
    {
        return $this->delete($this->get($supplierId));
    }
}
