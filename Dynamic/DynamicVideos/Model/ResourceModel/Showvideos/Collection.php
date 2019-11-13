<?php

namespace Dynamic\DynamicVideos\Model\ResourceModel\Showvideos;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dynamic\DynamicVideos\Model\Showvideos', 'Dynamic\DynamicVideos\Model\ResourceModel\Showvideos');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>