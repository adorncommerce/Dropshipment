<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Adorncommerce\Dropshipment\Helper;

use Dompdf\Dompdf as Dompdf;
use Dompdf\Options as Options;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Adorncommerce\Dropshipment\Api\SupplierRepositoryInterface;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Adorncommerce\Dropshipment\Api\SupplierTemplateRepositoryInterface;
use Adorncommerce\Dropshipment\Model\Config;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Io\File as FileIo;

class Data extends AbstractHelper
{
    // @codingStandardsIgnoreFile
    /**
     * @var SupplierRepositoryInterface
     */
    protected $supplierRepository;
    /**
     * @var SupplierTemplateRepositoryInterface
     */
    protected $supplierTemplateRepository;
    /**
     * @var Config
     */
    protected $config;
    /**
     * @var Filesystem
     */
    protected $fileSystem;
    /**
     * @var FileIo
     */
    protected $fileIo;

    /**
     * @param Context $context
     * @param SupplierRepositoryInterface $supplierRepository
     * @param SupplierTemplateRepositoryInterface $supplierTemplateRepository
     * @param Config $config
     * @param Filesystem $fileSystem
     * @param FileIo $fileIo
     */
    public function __construct(
        Context                             $context,
        SupplierRepositoryInterface         $supplierRepository,
        SupplierTemplateRepositoryInterface $supplierTemplateRepository,
        Config                              $config,
        Filesystem                          $fileSystem,
        FileIo                              $fileIo
    ) {
        $this->supplierRepository = $supplierRepository;
        $this->supplierTemplateRepository = $supplierTemplateRepository;
        $this->config = $config;
        $this->fileSystem = $fileSystem;
        $this->fileIo = $fileIo;
        parent::__construct($context);
    }

    /**
     * Get Supplier Email Content
     *
     * @param mixed $supplierId
     * @return array|string
     * @throws LocalizedException
     */
    public function getSupplierEmailContent($supplierId)
    {
        if ($supplierId) {
            $supplier = $this->supplierRepository->get($supplierId);
            $emailTemplate = $supplier->getEmailTemplate();
            $supplierEmailTemplateContent = [];
            if ($emailTemplate == "0") {
                $supplierEmailTemplateContent['email_subject'] = $supplier->getEmailSubject();
                $supplierEmailTemplateContent['email_header'] = $supplier->getEmailHeader();
                $supplierEmailTemplateContent['email_message'] = $supplier->getEmailMessage();
            } elseif ($emailTemplate != "0") {
                $supplierTemplate = $this->supplierTemplateRepository->get($emailTemplate);
                $supplierEmailTemplateContent['email_subject'] = $supplierTemplate->getEmailSubject() ??
                    $this->config->getEmailSubject();
                $supplierEmailTemplateContent['email_header'] = $supplierTemplate->getEmailHeader() ??
                    $this->config->getEmailHeader();
                $supplierEmailTemplateContent['email_message'] = $supplierTemplate->getEmailMessage() ??
                    $this->config->getEmailMessage();
            }
            return $supplierEmailTemplateContent;
        }
        return '';
    }

    /**
     * Get PDF
     *
     * @param mixed $html
     * @param mixed $orderId
     * @return array
     * @throws FileSystemException
     */
    public function getPoPdf($html, $orderId)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $fileName = 'Dropshipment_' . $orderId . '.pdf';
        $mediaRootDir = $this->fileSystem
                ->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
                ->getAbsolutePath() . 'Dropshipment PDF/';
        if (!is_dir($mediaRootDir)) {
            $this->fileIo->mkdir($mediaRootDir, 0775);
        }
        $newPdfName = $this->updateImageName($mediaRootDir, $fileName);
        $filePath = $mediaRootDir . $newPdfName;
        file_put_contents($filePath, $dompdf->output());
        return [$filePath, $newPdfName];
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
