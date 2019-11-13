<?php

namespace Dynamic\DynamicVideos\Model\ResourceModel\Dynamicvideos;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dynamic\DynamicVideos\Model\Dynamicvideos', 'Dynamic\DynamicVideos\Model\ResourceModel\Dynamicvideos');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>