<?php

namespace Dynamic\DynamicVideos\Block;

class DynamicVideo extends \Magento\Framework\View\Element\Template
{
    
    public function __construct( \Magento\Catalog\Block\Product\Context $context,
                                \Magento\Framework\ObjectManagerInterface $objectManager,
                                \Dynamic\DynamicVideos\Model\ShowvideosFactory $DynamicvideosFactory,
                                array $data = []) {
        $this->_objectManager         =     $objectManager;
        $this->_showvideosFactory = $DynamicvideosFactory;
        parent::__construct($context, $data);

    }
    public function getMediaUrl(){

        $mediaurl = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
                    ->getStore()
                    ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaurl;
    }

    public function getCurrentPageId(){
        $currentFullAction  = $this->_objectManager->get('\Magento\Cms\Model\Page');
        $pageId = $currentFullAction->getPageId();
        return $pageId;
    }
    
    public function getVideo($sortorder){
        $pageId = $this->getCurrentPageId();
       
        $collection = $this->_showvideosFactory->create()->getCollection();
        $collection->addFieldToFilter('page_id', array('eq' => $pageId));
        $collection->addFieldToFilter('sort_order', array('eq' => $sortorder));
        return $collection;
    }
}