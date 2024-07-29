<?php
namespace Magz\Categoryproductassign\Model;

use Magento\AsyncConfig\Api\Data\AsyncConfigMessageInterface;

class AsyncConfigMessage implements AsyncConfigMessageInterface
{
    private $categoryId;
    private $productSku;
    private $action;
    private $data;

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getProductSku()
    {
        return $this->productSku;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getConfigData()
    {
        return $this->data;
    }

    public function setConfigData(string $data)
    {
        $this->data = $data;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function setProductSku($productSku)
    {
        $this->productSku = $productSku;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setData($categoryId, $productSku, $action)
    {
        $this->setAction($action);
        $this->setCategoryId($categoryId);
        $this->setProductSku($productSku);
    }
}
