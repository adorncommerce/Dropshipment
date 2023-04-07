<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model;

use Adorncommerce\Dropshipment\Api\Data\DropshipmentInterface;
use Adorncommerce\Dropshipment\Api\Data\DropshipmentInterfaceFactory;
use Adorncommerce\Dropshipment\Api\Data\DropshipmentSearchResultsInterfaceFactory;
use Adorncommerce\Dropshipment\Api\DropshipmentRepositoryInterface;
use Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment as ResourceDropshipment;
use Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment\CollectionFactory as DropshipmentCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class DropshipmentRepository implements DropshipmentRepositoryInterface
{

    /**
     * @var DropshipmentInterfaceFactory
     */
    protected $dropshipmentFactory;

    /**
     * @var Dropshipment
     */
    protected $searchResultsFactory;

    /**
     * @var DropshipmentCollectionFactory
     */
    protected $dropshipmentCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ResourceDropshipment
     */
    protected $resource;

    /**
     * @param ResourceDropshipment $resource
     * @param DropshipmentInterfaceFactory $dropshipmentFactory
     * @param DropshipmentCollectionFactory $dropshipmentCollectionFactory
     * @param DropshipmentSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceDropshipment $resource,
        DropshipmentInterfaceFactory $dropshipmentFactory,
        DropshipmentCollectionFactory $dropshipmentCollectionFactory,
        DropshipmentSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->dropshipmentFactory = $dropshipmentFactory;
        $this->dropshipmentCollectionFactory = $dropshipmentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(DropshipmentInterface $dropshipment)
    {
        try {
            $this->resource->save($dropshipment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the dropshipment: %1',
                $exception->getMessage()
            ));
        }
        return $dropshipment;
    }

    /**
     * @inheritDoc
     */
    public function get($dropshipmentId)
    {
        $dropshipment = $this->dropshipmentFactory->create();
        $this->resource->load($dropshipment, $dropshipmentId);
        if (!$dropshipment->getId()) {
            throw new NoSuchEntityException(__('Dropshipment with id "%1" does not exist.', $dropshipmentId));
        }
        return $dropshipment;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->dropshipmentCollectionFactory->create();

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
    public function delete(DropshipmentInterface $dropshipment)
    {
        try {
            $dropshipmentModel = $this->dropshipmentFactory->create();
            $this->resource->load($dropshipmentModel, $dropshipment->getId());
            $this->resource->delete($dropshipmentModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Dropshipment: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($dropshipmentId)
    {
        return $this->delete($this->get($dropshipmentId));
    }
}
