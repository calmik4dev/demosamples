<?php

namespace Dynamic\DynamicVideos\Block\Adminhtml;

class Showvideos extends \Magento\Backend\Block\Widget\Container
{
    /**
     * @var string
     */
    protected $_template = 'dynamicvideos/showvideos.phtml';

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Widget\Context $context, 
        \Magento\Framework\App\Request\Http $request,
        \Magento\Catalog\Model\Session $catalogSession,
        array $data = [])
    {
        $this->request = $request;
        $this->catalogSession = $catalogSession;
        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {
        // $addButtonProps = [];
        //  $addButtonProps[] = [
        //     'id' => 'add_new',
        //     'label' => __('Add Video'),
        //     'class' => 'add',
        //     'button_class' => '',
        //     'class_name' => 'Magento\Backend\Block\Widget\Button\SplitButton',
        //     'options' => $this->_getAddButtonOptions(),
        // ];
        // $addButtonProps[] = [
        //     'id' => 'back_show',
        //     'label' => __('Back'),
        //     'class' => 'back',
        //     'button_class' => '',
        //     'onclick' => 'setLocation(\'' . $this->getUrl('router/controller/action') . '\')'
        // ];
      
        // $this->buttonList->add('add_new', $addButtonProps);
        $this->addButton(
        'add_new',
            [
                'id' => 'add_new',
                'label' => __('Add Video'),
                'class' => 'add',
                'button_class' => '',
                'class_name' => 'Magento\Backend\Block\Widget\Button\SplitButton',
                'options' => $this->_getAddButtonOptions(),
            ],
            -1
        );
        $this->addButton(
        'back',
            [
            'id' => 'back_show',
            'label' => __('Back'),
            'class' => 'back',
            'button_class' => '',
            'onclick' => 'setLocation(\'' . $this->getUrl('dynamicvideos/dynamicvideos/index') . '\')'
        ],
            -1
        );
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('Dynamic\DynamicVideos\Block\Adminhtml\Showvideos\Grid', 'dynamic.showvideos.grid')
        );
        return parent::_prepareLayout();
    }
    /**
     *
     *
     * @return array
     */
    protected function _getAddButtonOptions()
    {

        $splitButtonOptions[] = [
            'label' => __('Add New'),
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')"
        ];

        return $splitButtonOptions;
    }

    /**
     *
     *
     * @param string $type
     * @return string
     */
    protected function _getCreateUrl()
    {
        $page_id = $this->request->getParam('page_id');
        $this->catalogSession->setSelectPage($page_id);
        return $this->getUrl(
            'dynamicvideos/*/new/page_id/'.$page_id
        );
    }

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

}