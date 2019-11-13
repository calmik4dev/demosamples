<?php
namespace Dynamic\DynamicVideos\Model;

class Showvideos extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dynamic\DynamicVideos\Model\ResourceModel\Showvideos');
    }
}
?>