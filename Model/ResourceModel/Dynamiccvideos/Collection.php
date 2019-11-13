<?php

namespace Dynamicdd\Dynamicvideos\Model\ResourceModel\Dynamiccvideos;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dynamicdd\Dynamicvideos\Model\Dynamiccvideos', 'Dynamicdd\Dynamicvideos\Model\ResourceModel\Dynamiccvideos');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>