<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Adorncommerce\Dropshipment\Controller\Adminhtml\Supplier;

use Magento\Backend\App\Action\Context;
use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Io\File;
use Magento\Store\Model\StoreManagerInterface;

class Uploader extends \Magento\Backend\App\Action
{
    // @codingStandardsIgnoreFile
    /**
     * @var ImageUploader
     */
    protected $imageUploader;
    /**
     * @var Filesystem
     */
    protected $filesystem;
    /**
     * @var File
     */
    protected $fileIo;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Context $context
     * @param ImageUploader $imageUploader
     * @param Filesystem $filesystem
     * @param File $fileIo
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        ImageUploader $imageUploader,
        Filesystem $filesystem,
        File $fileIo,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
        $this->filesystem = $filesystem;
        $this->fileIo = $fileIo;
        $this->storeManager = $storeManager;
    }
    /**
     * Upload file controller action.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $imageUploadId = $this->getRequest()->getParam('param_name', 'supplier_logo');
        try {
            $imageResult = $this->imageUploader->saveFileToTmpDir($imageUploadId);
            // Upload image folder wise
            $imageName = $imageResult['name'];
            $basePath = $this->filesystem->
                getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath() . 'logo/image/';
            $mediaRootDir = $this->filesystem->
                getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath() . 'logo/image/';
            if (!is_dir($mediaRootDir)) {
                $this->fileIo->mkdir($mediaRootDir, 0775);
            }
            // Set image name with new name, If image already exist
            $newImageName = $this->updateImageName($mediaRootDir, $imageName);
            $this->fileIo->mv($basePath . $imageName, $mediaRootDir . $newImageName);
            // Upload image folder wise
            $imageResult['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
            $mediaUrl = $this->storeManager->getStore()->
            getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $imageResult['name'] = $newImageName;
            $imageResult['supplier_logo'] = $newImageName;
            $imageResult['url'] = $mediaUrl . 'logo/image/' . $newImageName;
        } catch (\Exception $e) {
            $imageResult = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($imageResult);
    }

    /**
     * Update Image Name
     *
     * @param mixed $path
     * @param mixed $file_name
     * @return string
     */
    public function updateImageName($path, $file_name)
    {
        if ($position = strrpos($file_name, '.')) {
            $name = substr($file_name, 0, $position);
            $extension = substr($file_name, $position);
        } else {
            $name = $file_name;
        }
        $new_file_path = $path . '/' . $file_name;
        $new_file_name = $file_name;
        $count = 0;
        while (file_exists($new_file_path)) {
            $new_file_name = $name . '_' . $count . $extension;
            $new_file_path = $path . '/' . $new_file_name;
            $count++;
        }
        return $new_file_name;
    }
}
