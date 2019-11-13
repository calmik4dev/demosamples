<?php

namespace Dynamic\DynamicVideos\Block\Adminhtml\Dynamicvideos;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize dynamicvideos edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Dynamic_DynamicVideos';
        $this->_controller = 'adminhtml_dynamicvideos';

        parent::_construct();
        $this->buttonList->update('back', 'onclick','setLocation("'.$this->_getBackUrl().'")');
        $this->buttonList->update('save', 'label', __('Save Video'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ]
            ],
            -100
        );

        $this->buttonList->update('delete', 'label', __('Delete Video'));
    }

    /**
     * Retrieve text for header element depending on loaded post
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('dynamicvideos')->getId()) {
            return __("Edit Videos '%1'", $this->escapeHtml($this->_coreRegistry->registry('dynamicvideos')->getTitle()));
        } else {
            return __('New Video');
        }
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('dynamicvideos/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '{{tab_id}}']);
    }
    protected function _getBackUrl()
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $catalogSession = $objectManager->create("Magento\Catalog\Model\Session");
        $page_id = $catalogSession->getSelectPage();
        return $this->getUrl('dynamicvideos/dynamicvideos/selectpage',['page_id' => $page_id]);
    }

    /**
     * Prepare layout
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'content');
                }
            };
        ";
        return parent::_prepareLayout();
    }

}