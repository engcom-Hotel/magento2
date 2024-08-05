<?php
namespace Magz\Issue39000\Model;

use Magz\Issue39000\Model\ResourceModel\Report\CollectionFactory;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Report extends AbstractCollection
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getReportData()
    {

        $collection = $this->collectionFactory->create();
        $collection->addCreditmemoToCollection();
    }
}
