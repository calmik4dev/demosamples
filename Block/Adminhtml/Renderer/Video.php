<?php
namespace Dynamic\DynamicVideos\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Store\Model\StoreManagerInterface;
 
class Video extends AbstractRenderer
{
   private $_storeManager;
   /**
    * @param \Magento\Backend\Block\Context $context
    * @param array $data
    */
   public function __construct(\Magento\Backend\Block\Context $context,  array $data = [])
   {
       parent::__construct($context, $data);
       $this->_authorization = $context->getAuthorization();
   }
   /**
    * Renders grid column
    *
    * @param Object $row
    * @return  string
    */
   public function render(\Magento\Framework\DataObject $row){
      $video = explode('/',$this->_getValue($row));
      if(isset($video[4])){
        return  $video[4];  
      }else{
        return "-";
      }

      
    }
}