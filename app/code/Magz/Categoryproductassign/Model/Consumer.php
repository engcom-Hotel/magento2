<?php

namespace Magz\Categoryproductassign\Model;

use Magento\Catalog\Model\CategoryLinkManagement;
use Magento\AsyncConfig\Api\Data\AsyncConfigMessageInterface;

class Consumer
{
    /**
     * @var CategoryLinkManagement
     */
    private  $categoryLinkManagement;

    /**
     * @param CategoryLinkManagement $categoryLinkManagement
     */
    public function __construct(CategoryLinkManagement $categoryLinkManagement) {
        $this->categoryLinkManagement = $categoryLinkManagement;
    }

    /**
     * Process the message
     *
     * @param AsyncConfigMessageInterface $message
     * @return void
     */
    public function process(AsyncConfigMessageInterface $message): void
    {
        echo "Current time: " . date('Y-m-d H:i:s') . PHP_EOL;
        // Extract data from the message
        $categoryId = $message->getCategoryId();
        $productSku = $message->getProductSku();
        $action = $message->getAction();

        echo "Current time: " . date('Y-m-d H:i:s') . PHP_EOL;
        echo "Picked SKU: ".$productSku." for category ID: ".$categoryId." with action: ".$action.PHP_EOL;
        // Perform the required operation based on the action
        if ($action === 'add') {
            $this->categoryLinkManagement->assignProductToCategories($productSku, [$categoryId]);
        }
    }
}
