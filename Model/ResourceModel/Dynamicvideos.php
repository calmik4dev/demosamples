<?php
namespace Dynamic\DynamicVideos\Model\ResourceModel;

class Dynamicvideos extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cms_page', 'page_id');
    }
}
?>