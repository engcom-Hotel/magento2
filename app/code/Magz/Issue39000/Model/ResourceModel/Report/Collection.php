<?php
namespace Magz\Issue39000\Model\ResourceModel\Report;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Magento\Sales\Model\Order\Creditmemo\Item',
            'Magento\Sales\Model\ResourceModel\Order\Creditmemo\Item'
        );
        $this->setMainTable('sales_creditmemo_item');
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addFilterToMap('created_at', 'creditmemo.created_at');
    }

    public function addCreditmemoToCollection(): void
    {
        $this->getSelect()
            ->joinInner(
                ['creditmemo' => $this->getTable('sales_creditmemo')],
                'creditmemo.entity_id = main_table.parent_id',
                ['created_at' => 'creditmemo.created_at']
            );
    }
}
