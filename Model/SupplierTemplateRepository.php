<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model;

use Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterface;
use Adorncommerce\Dropshipment\Api\Data\SupplierTemplateInterfaceFactory;
use Adorncommerce\Dropshipment\Api\Data\SupplierTemplateSearchResultsInterfaceFactory;
use Adorncommerce\Dropshipment\Api\SupplierTemplateRepositoryInterface;
use Adorncommerce\Dropshipment\Model\ResourceModel\SupplierTemplate as ResourceSupplierTemplate;
use Adorncommerce\Dropshipment\Model\ResourceModel\SupplierTemplate\CollectionFactory as
    SupplierTemplateCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class SupplierTemplateRepository implements SupplierTemplateRepositoryInterface
{

    /**
     * @var SupplierTemplate
     */
    protected $searchResultsFactory;

    /**
     * @var SupplierTemplateCollectionFactory
     */
    protected $supplierTemplateCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ResourceSupplierTemplate
     */
    protected $resource;

    /**
     * @var SupplierTemplateInterfaceFactory
     */
    protected $supplierTemplateFactory;

    /**
     * @param ResourceSupplierTemplate $resource
     * @param SupplierTemplateInterfaceFactory $supplierTemplateFactory
     * @param SupplierTemplateCollectionFactory $supplierTemplateCollectionFactory
     * @param SupplierTemplateSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSupplierTemplate $resource,
        SupplierTemplateInterfaceFactory $supplierTemplateFactory,
        SupplierTemplateCollectionFactory $supplierTemplateCollectionFactory,
        SupplierTemplateSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->supplierTemplateFactory = $supplierTemplateFactory;
        $this->supplierTemplateCollectionFactory = $supplierTemplateCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(
        SupplierTemplateInterface $supplierTemplate
    ) {
        try {
            $this->resource->save($supplierTemplate);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the supplierTemplate: %1',
                $exception->getMessage()
            ));
        }
        return $supplierTemplate;
    }

    /**
     * @inheritDoc
     */
    public function get($supplierTemplateId)
    {
        $supplierTemplate = $this->supplierTemplateFactory->create();
        $this->resource->load($supplierTemplate, $supplierTemplateId);
        if (!$supplierTemplate->getId()) {
            throw new NoSuchEntityException(__('SupplierTemplate with id "%1" does not exist.', $supplierTemplateId));
        }
        return $supplierTemplate;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->supplierTemplateCollectionFactory->create();
        
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
    public function delete(
        SupplierTemplateInterface $supplierTemplate
    ) {
        try {
            $supplierTemplateModel = $this->supplierTemplateFactory->create();
            $this->resource->load($supplierTemplateModel, $supplierTemplate->getSuppliertemplateId());
            $this->resource->delete($supplierTemplateModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SupplierTemplate: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($supplierTemplateId)
    {
        return $this->delete($this->get($supplierTemplateId));
    }
}
