<?php

namespace Dynamic\DynamicVideos\Controller\Adminhtml\dynamicvideos;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Selectpage extends \Magento\Backend\App\Action
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
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Dynamic_DynamicVideos::dynamicvideos');
        $resultPage->addBreadcrumb(__('Sambazon'), __('Sambazon'));
        $resultPage->addBreadcrumb(__('Manage Videos'), __('Manage Videos'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Videos'));

        return $resultPage;
    }
}
?>