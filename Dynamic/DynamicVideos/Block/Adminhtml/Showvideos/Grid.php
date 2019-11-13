<?php
namespace Dynamic\DynamicVideos\Block\Adminhtml\Showvideos;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Dynamic\DynamicVideos\Model\dynamicvideosFactory
     */
    protected $_showvideosFactory;


    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Dynamic\DynamicVideos\Model\dynamicvideosFactory $dynamicvideosFactory
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Dynamic\DynamicVideos\Model\ShowvideosFactory $DynamicvideosFactory,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Catalog\Model\Session $catalogSession, 
        array $data = []
    ) {
         $this->catalogSession = $catalogSession;
        $this->_showvideosFactory = $DynamicvideosFactory;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('videoGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_showvideosFactory->create()->getCollection();
        $page_id = $this->catalogSession->getSelectPage();
        $collection->addFieldToFilter('page_id', array('eq' => $page_id));
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );
        $this->addColumn(
            'video_title',
            [
                'header' => __('Video title'),
                'index' => 'video_title',
            ]
        );
        $this->addColumn(
            'video_description',
            [
                'header' => __('Content'),
                'index' => 'video_description',
            ]
        );
        $this->addColumn(
            'video_live_link',
            [
                'header' => __('Video Youtube Link'),
                'index' => 'video_live_link',
            ]
        );

        
        $this->addColumn(
            'video_manually_upload',
            [
                'header' => __('Video Manually Upload Name'),
                'index' => 'video_manually_upload',
                'renderer'  => '\Dynamic\DynamicVideos\Block\Adminhtml\Renderer\Video',
            ]
        );
        $this->addColumn(
            'opacity',
            [
                'header' => __('Opacity'),
                'index' => 'opacity',
            ]
        );
        $this->addColumn(
            'desktop_background_image',
            [
                'header' => __('Desktop Background Image'),
                'index' => 'desktop_background_image',
                'renderer'  => '\Dynamic\DynamicVideos\Block\Adminhtml\Renderer\Image',
                'filter' => false,
                'sortable' => false,
            ]
        );
        $this->addColumn(
            'mobile_background_image',
            [
                'header' => __('Mobile Background Image'),
                'index' => 'mobile_background_image',
                'renderer'  => '\Dynamic\DynamicVideos\Block\Adminhtml\Renderer\Mobileimage',
                'filter' => false,
                'sortable' => false,
            ]
        );
        $this->addColumn(
            'sort_order',
            [
                'header' => __('Sort Order'),
                'index' => 'sort_order',
            ]
        );
        $this->addColumn(
            'created_date',
            [
                'header' => __('Created Date'),
                'index' => 'created_date',
            ]
        );
        $this->addColumn(
            'updated_date',
            [
                'header' => __('Updated Date#'),
                'index' => 'updated_date',
            ]
        );
                


        
        $this->addColumn(
            'select',
            [
                'header' => __('Select'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );
        

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	

    /**
     * @return string
     */
    public function getGridUrl()
    {
        $page_id = $this->catalogSession->getSelectPage();
        return $this->getUrl('dynamicvideos/dynamicvideos/selectpage', ['page_id' => $page_id]);
    }

    /**
     * @param \Dynamic\DynamicVideos\Model\dynamicvideos|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'dynamicvideos/*/edit',
            ['id' => $row->getId()]
        );
		
    }
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        // $this->getMassactionBlock()->setTemplate('Dynamic_DynamicVideos::dynamicvideos/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('dynamicvideos');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('dynamicvideos/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        return $this;
    }
	

}