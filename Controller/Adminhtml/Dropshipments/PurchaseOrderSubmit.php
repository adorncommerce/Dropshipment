<?php
/**
 * Copyright 2023 Adorncommerce LLP. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Adorncommerce\Dropshipment\Controller\Adminhtml\Dropshipments;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Sales\Api\OrderItemRepositoryInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Adorncommerce\Dropshipment\Api\DropshipmentRepositoryInterface;
use Adorncommerce\Dropshipment\Api\SupplierRepositoryInterface;
use Adorncommerce\Dropshipment\Api\Data\SupplierInterface;
use Adorncommerce\Dropshipment\Model\DropshipmentFactory;
use Adorncommerce\Dropshipment\Model\ResourceModel\Dropshipment\CollectionFactory as DropshipmentCollectionFactory;
use Adorncommerce\Dropshipment\Model\Config;
use Adorncommerce\Dropshipment\Model\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Sales\Model\Order\Address\Renderer;
use Magento\Framework\Pricing\Helper\Data;
use Adorncommerce\Dropshipment\Helper\Data as DropshipmentHelper;
use Magento\Framework\Mail\Template\FactoryInterface;
use Magento\Framework\Filesystem\Driver\File as FileReader;
use Magento\Store\Model\StoreManagerInterface;

class PurchaseOrderSubmit extends \Magento\Backend\App\Action
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;
    /**
     * @var DropshipmentFactory
     */
    protected $dropshipmentFactory;
    /**
     * @var DropshipmentRepositoryInterface
     */
    protected $dropshipmentRepository;
    /**
     * @var SupplierRepositoryInterface
     */
    protected $supplierRepository;
    /**
     * @var OrderItemRepositoryInterface
     */
    protected $orderItemRepository;

    /**
     * @var DropshipmentCollectionFactory
     */
    protected $dropshipmentCollectionFactory;
    /**
     * @var Config
     */
    protected $config;
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;
    /**
     * @var StateInterface
     */
    protected $inlineTranslation;
    /**
     * @var Renderer
     */
    protected $addressRenderer;
    /**
     * @var Data
     */
    protected $pricingHelper;
    /**
     * @var DropshipmentHelper
     */
    protected $dropshipmentHelper;
    /**
     * @var FactoryInterface
     */
    protected $templateFactory;
    /**
     * @var FileReader
     */
    protected $fileReader;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Context $context
     * @param OrderRepositoryInterface $orderRepository
     * @param DropshipmentFactory $dropshipmentFactory
     * @param DropshipmentRepositoryInterface $dropshipmentRepository
     * @param SupplierRepositoryInterface $supplierRepository
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param DropshipmentCollectionFactory $dropshipmentCollectionFactory
     * @param Config $config
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param Renderer $addressRenderer
     * @param Data $pricingHelper
     * @param DropshipmentHelper $dropshipmentHelper
     * @param FactoryInterface $templateFactory
     * @param FileReader $fileReader
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context                         $context,
        OrderRepositoryInterface        $orderRepository,
        DropshipmentFactory             $dropshipmentFactory,
        DropshipmentRepositoryInterface $dropshipmentRepository,
        SupplierRepositoryInterface     $supplierRepository,
        OrderItemRepositoryInterface    $orderItemRepository,
        DropshipmentCollectionFactory   $dropshipmentCollectionFactory,
        Config                          $config,
        TransportBuilder                $transportBuilder,
        StateInterface                  $inlineTranslation,
        Renderer                        $addressRenderer,
        Data                            $pricingHelper,
        DropshipmentHelper              $dropshipmentHelper,
        FactoryInterface                $templateFactory,
        FileReader                      $fileReader,
        StoreManagerInterface           $storeManager
    ) {
        $this->orderRepository = $orderRepository;
        $this->dropshipmentFactory = $dropshipmentFactory;
        $this->dropshipmentRepository = $dropshipmentRepository;
        $this->supplierRepository = $supplierRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->dropshipmentCollectionFactory = $dropshipmentCollectionFactory;
        $this->config = $config;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->addressRenderer = $addressRenderer;
        $this->pricingHelper = $pricingHelper;
        $this->dropshipmentHelper = $dropshipmentHelper;
        $this->templateFactory = $templateFactory;
        $this->fileReader = $fileReader;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Execute Method
     *
     * @return void
     * @throws LocalizedException
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $order = $this->orderRepository->get($this->getRequest()->getParam('id'));

        if (!empty($order)) {
            $orderStatus = $order->getStatus();
            if ($orderStatus == "canceled" || $orderStatus == "complete" || $orderStatus == "closed" ||
                $orderStatus == "fraud") {
                $this->messageManager->
                addErrorMessage("Can't proceed to submit Purchase Order due order status is $orderStatus");
                $this->_redirect('sales/order/view/order_id/' . $this->getRequest()->getParam('id'));
                return;
            }
        }
        $this->saveDropshipitem($data);
        $this->messageManager->addSuccessMessage('Order is dropshipped succesfully');
        $this->_redirect('sales/order/view/order_id/' . $this->getRequest()->getParam('id'));
    }

    /**
     * Save Dropshipment
     *
     * @param mixed $data
     * @return void
     * @throws LocalizedException
     * @throws MailException
     */
    public function saveDropshipitem($data)
    {
        $purchaseOrderPreFix = $this->config->getDropshipmentPrefix();
        $supplierItem = [];
        if (isset($data['supplier']) && !empty($data['supplier'])) {
            foreach ($data['supplier'] as $dropshipItem) {
                if ($dropshipItem['supplier_id'] != "") {
                    $dropshipmentData = $this->dropshipmentFactory->create();
                    if ($lastDropshipmentNumber = $this->getNextDropshipmentId()->getDropshipmentId()) {
                        $prefixPosition = strpos($lastDropshipmentNumber, $purchaseOrderPreFix);
                        if ($prefixPosition !== false && $prefixPosition === 0) {
                            $incrementId = substr_replace($lastDropshipmentNumber, '', $prefixPosition, strlen($purchaseOrderPreFix));
                        }
                        $splitIncrementId = explode('-', $lastDropshipmentNumber);
                        if (is_array($splitIncrementId) && (count($splitIncrementId) > 1)) {
                            unset($splitIncrementId[0]);
                            $parentIncrementId = implode('-', $splitIncrementId);
                            $parentIncrementId = (int)$parentIncrementId + 1;
                        } else {
                            $parentIncrementId = (int)$incrementId + 1;
                        }
                        $newDropshipmentNumber = $purchaseOrderPreFix . $parentIncrementId;
                    } else {
                        $newDropshipmentNumber = $purchaseOrderPreFix . "10000000";
                    }
                    $dropshipItem['dropshipment_id'] = $newDropshipmentNumber;
                    $supplier = $this->getSupplier($dropshipItem['supplier_id']);
                    $dropshipItem['supplier_name'] = $supplier->getSupplierCode();
                    $dropshipmentData->setData($dropshipItem);
                    $this->dropshipmentRepository->save($dropshipmentData);
                    $this->orderStatusChange($dropshipItem['order_id']);
                    $this->updateIsDropshipGenerated((int)$dropshipItem['order_item_id']);
                    $supplierItem[$dropshipItem['supplier_id']][] = $dropshipmentData->getData();
                }
            }
            $this->sendEmail($supplierItem, $dropshipItem['order_id']);
        }
    }

    /**
     * Get Supplier
     *
     * @param mixed $supplierId
     * @return SupplierInterface|string
     * @throws LocalizedException
     */
    public function getSupplier($supplierId)
    {
        if ($supplierId) {
            return $this->supplierRepository->get($supplierId);
        }
        return "";
    }

    /**
     * Update Is Dropship Generated
     *
     * @param mixed $itemId
     * @return ResponseInterface|void
     */
    public function updateIsDropshipGenerated($itemId)
    {
        try {
            $item = $this->orderItemRepository->get($itemId);
            if ($item) {
                $item->setIsDropshipGenerated(1);
                $item->save();
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->_redirect('sales/order/view/order_id/' . $this->getRequest()->getParam('id'));
        }
    }

    /**
     * Next Dropshipment Id
     *
     * @return mixed
     */
    public function getNextDropshipmentId()
    {
        return $this->dropshipmentCollectionFactory->create()->getLastItem();
    }

    /**
     * Order Status Change
     *
     * @param mixed $orderId
     * @return void
     */
    public function orderStatusChange($orderId)
    {
        $isOrderStatusChange = $this->config->getIsOrderStatusChange();
        if ($isOrderStatusChange) {
            $orderStatus = $this->config->getOrderStatus();
            $order = $this->orderRepository->get($orderId);
            $order->setStatus($orderStatus);
            $this->orderRepository->save($order);
        }
    }

    /**
     * Send Email
     *
     * @param mixed $items
     * @param mixed $orderId
     * @return void
     * @throws LocalizedException
     * @throws MailException
     */
    public function sendEmail($items, $orderId)
    {
        if (!empty($items)) {
            foreach ($items as $supplierId => $item) {
                $supplier = $this->getSupplier($supplierId);
                $emailContent = $this->dropshipmentHelper->getSupplierEmailContent($supplierId);
                $order = $this->orderRepository->get($orderId);
                $shippingAddress = $order->getShippingAddress();
                $billingAddress = $order->getBillingAddress();
                $orderCreatedAt = $order->getCreatedAt();
                $formattedShippingAddress = $this->addressRenderer->format($shippingAddress, 'html');
                $formattedBillingAddress = $this->addressRenderer->format($billingAddress, 'html');
                $mediaUrl = $this->storeManager->getStore()->
                getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
                $supplierLogo = $supplier->getSupplierLogo() ?
                    $mediaUrl . 'logo/image/' . $supplier->getSupplierLogo() : false;
                $templateVars = [
                    'order_increment_id' => $order->getIncrementId(),
                    'order_created_at' => $orderCreatedAt,
                    'email_header' => $emailContent['email_header'],
                    'email_message' => $emailContent['email_message'],
                    'shipping_info' => $formattedShippingAddress,
                    'billing_info' => $formattedBillingAddress,
                    'email_subject' => $emailContent['email_subject'],
                    'items' => $item,
                    'supplier_logo' => $supplierLogo,
                    'total_cost' => $this->pricingHelper->currency(
                        $this->getTotalCosts($item),
                        true,
                        false
                    )
                ];
                $this->inlineTranslation->suspend();
                $to = $supplier->getSupplierEmail();
                $templateOptions = [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => 1
                ];
                $sender = $this->config->getEmailSenderEmail();
                $transport = $this->transportBuilder
                    ->setTemplateIdentifier('dropshipment_email')
                    ->setTemplateOptions($templateOptions)
                    ->setTemplateVars($templateVars)
                    ->setFrom($sender)
                    ->addTo($to);

                if (!empty($this->config->getBccEmailAddress())) {
                    $emails = explode(',', $this->config->getBccEmailAddress());
                    foreach ($emails as $email) {
                        $transport->addBcc($email);
                    }
                }
                if ($this->config->getIsPdfSendInEmail()) {
                    $pdfTemplate = $this->templateFactory->get('dropshipment_pdf')
                        ->setVars($templateVars)
                        ->setOptions($templateOptions);

                    $html = $pdfTemplate->processTemplate();
                    $pdfLocation = $this->dropshipmentHelper->getPoPdf($html, $orderId);
                    $this->transportBuilder->addAttachment(
                        $this->fileReader->fileGetContents($pdfLocation['0']),
                        $pdfLocation['1']
                    );
                }
                $transport->getTransport()->sendMessage();
                $this->inlineTranslation->resume();
            }
        }
    }

    /**
     * Get Total Costs
     *
     * @param mixed $items
     * @return float
     */
    protected function getTotalCosts($items)
    {
        $cost = 0;
        foreach ($items as $item) {
            if ($item['qty_dropshipped']) {
                $qty = (int)$item['qty_dropshipped'];
            } else {
                $qty = (int)$item['qty'];
            }
            $baseCost = (float)$item['cost'];
            $cost += str_replace(",", "", $baseCost) * (int)$qty;
        }
        return round($cost, 2);
    }
}
