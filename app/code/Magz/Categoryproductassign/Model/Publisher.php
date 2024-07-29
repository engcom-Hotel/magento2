<?php
namespace Magz\Categoryproductassign\Model;

use Magento\AsyncConfig\Api\Data\AsyncConfigMessageInterface;
use Magento\Catalog\Model\CategoryLinkManagement;
use Magento\Catalog\Model\CategoryLinkRepository;
use Magento\Framework\MessageQueue\PublisherInterface;

class Publisher
{

    /**
     * @var CategoryLinkManagement
     */
    private $categoryLinkManagement;

    /**
     * @var CategoryLinkRepository
     */
    private $categoryLinkRepository;
    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * @var AsyncConfigMessage
     */
    private $messageObject;

    /**
     * @param PublisherInterface $publisher
     */
    public function __construct(PublisherInterface $publisher,
                                CategoryLinkManagement $categoryLinkManagement,
                                CategoryLinkRepository $categoryLinkRepository,
                                AsyncConfigMessage $messageObject)
    {
        $this->publisher = $publisher;
        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->categoryLinkRepository = $categoryLinkRepository;
        $this->messageObject = $messageObject;
    }

    /**
     * Publish message to the queue
     *
     * @param array $message
     * @return void
     */
    public function publish($message)
    {
        if($message['action'] == 'add') {
            $products = $this->getAssignedProducts($message['category_id']);
            if(count($products) > 0) {
                foreach($products as $product) {
                    $this->messageObject->setConfigData($product->getSku());
                    $this->messageObject->setData($message['category_id'], $product->getSku(), 'add');
                    $this->publisher->publish('categoryproductassign.topic', $this->messageObject);
                    //print the message on terminal
                    echo "Message published for: " . $product->getSku() . PHP_EOL;
                    #$this->categoryLinkManagement->assignProductToCategories($product->getSku(), [3]);
                }
            } else {
                echo "No Products found";
            }
        }
    }

    public function getAssignedProducts($categoryId) {
        $products = $this->categoryLinkManagement->getAssignedProducts($categoryId);
        return $products;
    }
}
