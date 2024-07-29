<?php

namespace Magz\Categoryproductassign\Model;

use Magento\Catalog\Model\CategoryLinkManagement;
use Magento\AsyncConfig\Api\Data\AsyncConfigMessageInterface;
use Magento\Framework\Serialize\Serializer\Json;

class Consumer
{
    /**
     * @var CategoryLinkManagement
     */
    private  $categoryLinkManagement;

    /**
     * @var Json
     */
    private $json;

    /**
     * @param CategoryLinkManagement $categoryLinkManagement
     */
    public function __construct(CategoryLinkManagement $categoryLinkManagement, Json $json) {
        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->json = $json;
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
        $configData = $message->getConfigData();
        $data = $this->json->unserialize($configData);
        $categoryId = $data['category_id'];
        $productSku = $data['product_sku'];
        $action = $data['action'];

        echo "Current time: " . date('Y-m-d H:i:s') . PHP_EOL;
        echo "Picked SKU: ".$productSku." for category ID: ".$categoryId." with action: ".$action.PHP_EOL;
        // Perform the required operation based on the action
        if ($action === 'add') {
            $this->categoryLinkManagement->assignProductToCategories($productSku, [$categoryId]);
        }
    }
}
