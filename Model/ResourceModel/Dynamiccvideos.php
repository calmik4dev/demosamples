<?php
namespace Dynamicdd\Dynamicvideos\Model\ResourceModel;

class Dynamiccvideos extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dynamic_videos', 'id');
    }
}
?>