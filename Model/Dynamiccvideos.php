<?php
namespace Dynamicdd\Dynamicvideos\Model;

class Dynamiccvideos extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dynamicdd\Dynamicvideos\Model\ResourceModel\Dynamiccvideos');
    }
}
?>