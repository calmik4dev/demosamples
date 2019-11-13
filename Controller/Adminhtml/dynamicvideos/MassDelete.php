<?php
namespace Dynamic\DynamicVideos\Controller\Adminhtml\dynamicvideos;

use Magento\Backend\App\Action;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action
{
   
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {

        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $catalogSession = $objectManager->create("Magento\Catalog\Model\Session");
        $page_id = $catalogSession->getSelectPage();
        $itemIds = $this->getRequest()->getParam('dynamicvideos');
        if (!is_array($itemIds) || empty($itemIds)) {
            $this->messageManager->addError(__('Please select video(s).'));
        } else {
            try {
                foreach ($itemIds as $itemId) {
                    $post = $this->_objectManager->get('Dynamic\DynamicVideos\Model\Showvideos')->load($itemId);
                    $post->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($itemIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('dynamicvideos/dynamicvideos/selectpage/',['page_id' => $page_id, '_current' => true]);
    }
}