<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Adorncommerce\Dropshipment\Model\Supplier;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Adorncommerce\Dropshipment\Model\ResourceModel\Supplier\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * @param mixed $name
     * @param mixed $primaryFieldName
     * @param mixed $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManager
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get Data
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            if (isset($model['supplier_logo']) && $model['supplier_logo']) {
                $model['supplier_logo'] = [
                    [
                        'name' => $model['supplier_logo'],
                        'url' => $this->storeManager->getStore()
                                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'logo/image/' .
                            $model['supplier_logo'],
                    ],
                ];
            } else {
                $model['supplier_logo'] = null;
            }

            $this->loadedData[$model->getId()]['general'] = $model->getData();
            $this->loadedData[$model->getId()]['supplier_email_template_configuration']['email_template'] =
                $model->getEmailTemplate();
            $this->loadedData[$model->getId()]['supplier_email_template_configuration']['email_subject'] =
                $model->getEmailSubject();
            $this->loadedData[$model->getId()]['supplier_email_template_configuration']['email_header'] =
                $model->getEmailHeader();
            $this->loadedData[$model->getId()]['supplier_email_template_configuration']['email_message'] =
                $model->getEmailMessage();
        }
        $data = $this->dataPersistor->get('adorncommerce_dropshipment_supplier');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            if (isset($model['supplier_logo']) && $model['supplier_logo']) {
                if (array_key_exists(0, $model['supplier_logo'])) {
                    $model['supplier_logo'] = [
                        [
                            'name' => $model['supplier_logo'][0]['name'],
                            'url' => $this->storeManager->getStore()
                                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'logo/image/' .
                                $model['supplier_logo'][0]['name'],
                        ],
                    ];
                } else {
                    $model['supplier_logo'] = [
                        [
                            'name' => $model['supplier_logo'],
                            'url' => $this->storeManager->getStore()
                                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'logo/image/' .
                                $model['supplier_logo'],
                        ],
                    ];
                }
            } else {
                $model['supplier_logo'] = null;
            }
            $this->loadedData[$model->getId()]['general'] = $model->getData();
            $this->loadedData[$model->getId()]['supplier_email_template_configuration'] = $model->getData();
            $this->dataPersistor->clear('adorncommerce_dropshipment_supplier');
        }
        return $this->loadedData;
    }
}
