<?php

namespace Dynamic\DynamicVideos\Controller\Adminhtml\dynamicvideos;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPagee;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $catalogSession = $this->_objectManager->create("Magento\Catalog\Model\Session");
        $catalogSession->unsSelectPage();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Dynamic_DynamicVideos::dynamicvideos');
        $resultPage->addBreadcrumb(__('Sambazon'), __('Sambazon'));
        $resultPage->addBreadcrumb(__('Pages'), __('Pages'));
        $resultPage->getConfig()->getTitle()->prepend(__('Pages'));

        return $resultPage;
    }
}
?>