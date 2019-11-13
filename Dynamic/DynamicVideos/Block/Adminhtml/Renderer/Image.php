<?php
namespace Dynamic\DynamicVideos\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Store\Model\StoreManagerInterface;
 
class Image extends AbstractRenderer
{
   private $_storeManager;
   /**
    * @param \Magento\Backend\Block\Context $context
    * @param array $data
    */
   public function __construct(\Magento\Backend\Block\Context $context, StoreManagerInterface $storemanager, array $data = [])
   {
       $this->_storeManager = $storemanager;
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
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
           \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
       );
       $imageUrl = $mediaDirectory.$this->_getValue($row);
       $html = '<a  style="display: inline-block;text-align: center;width: 100%;" id="popup-modal-'.$row->getId().'" href="javascript:void(0);" data-href="'.$imageUrl.'" ><img src="'.$imageUrl.'" width="250"/></a>';
       $html .= "
       <script>
          require([
                  'jquery',
                  'Magento_Ui/js/modal/modal'
              ],
              function(
                  $,
                  modal
              ) {
                  var options = {
                      type: 'popup',
                      responsive: true,
                      innerScroll: true,
                      title: 'Image Preview',
                      buttons: [{
                          text: $.mage.__('Close'),
                          class: '',
                          click: function () {
                              this.closeModal();
                          }
                      }]
                  };
                  $('#popup-modal-".$row->getId()."').on('click',function(){ 
                      var imgTag = $(\"<img id='popup-img-".$row->getId()."' style='text-align: center;margin: 0 auto;display: block;' src='\"+$(this).attr(`data-href`)+\"' /> \");
                      var popup = modal(options, imgTag);
                      imgTag.modal('openModal');
                  });

              }
          );
      </script>";
       return  $html;
    }
}