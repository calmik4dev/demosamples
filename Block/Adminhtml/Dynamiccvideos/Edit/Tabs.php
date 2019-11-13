<?php
namespace Dynamicdd\Dynamicvideos\Block\Adminhtml\Dynamiccvideos\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('dynamiccvideos_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Dynamiccvideos Information'));
    }
}