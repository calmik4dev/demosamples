<?php
namespace Dynamic\DynamicVideos\Controller\Adminhtml\dynamicvideos;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context,\Magento\Framework\Filesystem\Driver\File $file)
    {
        $this->_file = $file;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Dynamic\DynamicVideos\Model\Showvideos');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                $model->setUpdatedAt(date('Y-m-d H:i:s'));
            }else{
                $data['created_date']=date('Y-m-d H:i:s');
                $data['updated_date']=date('Y-m-d H:i:s');
            }
		    // if($data['video_live_link']==""){
               
      //           if($_FILES['video_manually_upload']['name']==""){
      //               $this->messageManager->addError("Video cant Save Please Specify Either Video link or Manually Upload a video.");
      //               return $resultRedirect->setPath('dynamicvideos/dynamicvideos/selectpage/',['page_id' => $data['selectpage_id']]);
      //           }
      //       }
			if(isset($_FILES['video_manually_upload']['name']) && $_FILES['video_manually_upload']['name']!="" ){
                try{
                    $uploader = $this->_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'video_manually_upload']
                    );
                    $uploader->setAllowedExtensions(['AVI', 'FLV', 'WMV', 'MOV','MP4','pdf']);
                    /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                    $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                        ->getDirectoryRead(DirectoryList::MEDIA);
                    $result = $uploader->save($mediaDirectory->getAbsolutePath('dynamic_video/manual_video_upload'));
                        if($result['error']==0)
                        {
                            $data['video_manually_upload'] = 'dynamic_video/manual_video_upload' . $result['file'];
                        }
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    return $resultRedirect->setPath('dynamicvideos/dynamicvideos/selectpage/',['page_id' => $data['selectpage_id']]);
                }
           }
           else if(isset($data['video_manually_upload']['delete'])){
                $fileName=$data['video_manually_upload']['value'];
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                $mediaRootDir = $mediaDirectory->getAbsolutePath();

                if ($this->_file->isExists($mediaRootDir . $fileName))  {

                    $this->_file->deleteFile($mediaRootDir . $fileName);
                }
                $data['video_manually_upload']= "";
           }
           else if(isset($data['video_manually_upload']['value'])){
            $video_manually_upload=$data['video_manually_upload']['value'];
            unset($data['video_manually_upload']);
            $data['video_manually_upload']=$video_manually_upload;
           }

           if(isset($_FILES['desktop_background_image']['name']) && $_FILES['desktop_background_image']['name']!="" ){
                try{
                    $uploader = $this->_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'desktop_background_image']
                    );
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                    $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                        ->getDirectoryRead(DirectoryList::MEDIA);
                    $result = $uploader->save($mediaDirectory->getAbsolutePath('dynamic_video/desktop_background_image'));
                        if($result['error']==0)
                        {
                            $data['desktop_background_image'] = 'dynamic_video/desktop_background_image' . $result['file'];
                        }
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    return $resultRedirect->setPath('dynamicvideos/dynamicvideos/selectpage/',['page_id' => $data['selectpage_id']]);

                }
           }
           else if(isset($data['desktop_background_image']['value'])){
            $desktop_background_image=$data['desktop_background_image']['value'];
            unset($data['desktop_background_image']);
            $data['desktop_background_image']=$desktop_background_image;
           }

           if(isset($_FILES['mobile_background_image']['name']) && $_FILES['mobile_background_image']['name']!="" ){
                try{
                    $uploader = $this->_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'mobile_background_image']
                    );
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                    $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                        ->getDirectoryRead(DirectoryList::MEDIA);
                    $result = $uploader->save($mediaDirectory->getAbsolutePath('dynamic_video/mobile_background_image'));
                        if($result['error']==0)
                        {
                            $data['mobile_background_image'] = 'dynamic_video/mobile_background_image' . $result['file'];
                        }
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    return $resultRedirect->setPath('dynamicvideos/dynamicvideos/selectpage/',['page_id' => $data['selectpage_id']]);
                }
           }
           else if(isset($data['mobile_background_image']['value'])){
            $mobile_background_image=$data['mobile_background_image']['value'];
            unset($data['mobile_background_image']);
            $data['mobile_background_image']=$mobile_background_image;
           }
           $data['page_id'] =$data['selectpage_id'];
            $model->setData($data);

            try {

                $model->save();
                $this->messageManager->addSuccess(__('The Video has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('dynamicvideos/dynamicvideos/selectpage/',['page_id' => $data['selectpage_id']]);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the video.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}