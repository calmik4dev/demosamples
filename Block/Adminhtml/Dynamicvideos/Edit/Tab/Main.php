<?php

namespace Dynamic\DynamicVideos\Block\Adminhtml\Dynamicvideos\Edit\Tab;

/**
 * Dynamicvideos edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;



    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig, 
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        $this->catalogSession = $catalogSession;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Dynamic\DynamicVideos\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('dynamicvideos');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Video Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);

        }else{
             $model->setData('opacity', "80");
        }
        $page_id = $this->catalogSession->getSelectPage();
        $fieldset->addField('selectpage_id', 'hidden', ['name' => 'selectpage_id']);
        // $form->setValues('page_id', $page_id);
         $model->setData('selectpage_id', $page_id);
		$fieldset->addField(
            'video_title',
            'text',
            [
                'name' => 'video_title',
                'label' => __('Video Title'),
                'title' => __('Video Title'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        $fieldset->addField(
            'video_description',
            'editor',
            [
                'name' => 'video_description',
                'label' => __('Video Content'),
                'title' => __('Video Content'),
                'required' => true,
                'disabled' => $isElementDisabled,
                 'config' => $this->_wysiwygConfig->getConfig()
            ]
        );

        $fieldset->addField(
            'video_live_link',
            'textarea',
            [
                'name' => 'video_live_link',
                'label' => __('Video Youtube Link'),
                'title' => __('Video Youtube Link'),
                'disabled' => $isElementDisabled
            ]
        );
		$fieldset->addField(
            'video_manually_upload',
            'image',
            [
                'name' => 'video_manually_upload',
                'label' => __('Video Manually Upload'),
                'title' => __('Video Manually Upload'),
                 'note' => __('Allowed image types: mp4 Maximum Upload Size : 2Mb'),
                'disabled' => $isElementDisabled
            ]
        )->setAfterElementHtml('
            <script>
                require([
                     "jquery",
                     "jquery/ui",
                    "Magento_Ui/js/modal/modal",
                ], function($){
                    $(document).ready(function () {
                        var d=$("#page_video_manually_upload_image").attr("src");
                        if(d!=undefined){
                            d = d.split("/");
                            $("#page_video_manually_upload_image").css("display","none");
                            $("#page_video_manually_upload_image").parent().parent().append("<br>"+d[d.length-1])
                        }
                        
                        
                       
                    });
                  });
           </script>
        ');
        $fieldset->addField(
            'desktop_background_image',
            'image',
            [
                'name' => 'desktop_background_image',
                'label' => __('Desktop Background Image'),
                'title' => __('Desktop Background Image'),
                
                'disabled' => $isElementDisabled,
                'required' => true, 
                'data-form-part' => $this->getData('target_form'),
                'value' => "",
                'note' => __('Allowed image types: jpg,png,jpeg,gif')
            ]
        );
        $fieldset->addField(
            'mobile_background_image',
            'image',
            [
                'name' => 'mobile_background_image',
                'label' => __('Mobile Background Image'),
                'title' => __('Mobile Background Image'),
                'disabled' => $isElementDisabled,
                'required' => true, 
                'data-form-part' => $this->getData('target_form'),
                'value' => "",
                'note' => __('Allowed image types: jpg,png,jpeg,gif')
            ]
        );
        $fieldset->addField(
            'opacity',
            'text',
            [
                'name' => 'opacity',
                'label' => __('Opacity'),
                'title' => __('Opacity'),
                'required' => true, 
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'sort_order',
            'text',
            [
                'name' => 'sort_order',
                'label' => __('Sort Order'),
                'title' => __('Sort Order'),
                'required' => true, 
                'disabled' => $isElementDisabled
            ]
        )->setAfterElementHtml('
            <script>
                require([
                     "jquery",
                     "jquery/ui",
                    "Magento_Ui/js/modal/modal",
                ], function($){
                    $(document).ready(function () {
                       
                        $("#page_opacity").on("keypress keyup blur",function (event) {
                      
                            $(this).val($(this).val().replace(/[^0-9\.]/g,""));
                                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                                    event.preventDefault();
                                }
                        });
                         $("#page_sort_order").on("keypress keyup blur",function (event) {    
                           $(this).val($(this).val().replace(/[^\d].+/, ""));
                            if ((event.which < 48 || event.which > 57)) {
                                event.preventDefault();
                            }
                        });
                        $("#page_desktop_background_image_delete").css("display","none");
                        $("#page_mobile_background_image_delete").css("display","none");
                        $("label[for=\'page_desktop_background_image_delete\']").css("display","none");
                        $("label[for=\'page_mobile_background_image_delete\']").css("display","none");
                        $("label[for=\'page_video_manually_upload_delete\']").text("Delete Video");

                    });
                  });
           </script>
        ');

        // $fieldset->addField(
        //     'content',
        //     'text',
        //     [
        //         'name' => 'content',
        //         'label' => __('content'),
        //         'title' => __('content'),
				
        //         'disabled' => $isElementDisabled
        //     ]
        // );
					

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Video Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Video Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
