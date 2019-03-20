<?php

namespace Raccoon\Bloggers\Controller\Adminhtml\bloggers;

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
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Raccoon_Bloggers::bloggers');
        $resultPage->addBreadcrumb(__('Raccoon'), __('Raccoon'));
        $resultPage->addBreadcrumb(__('Manage item'), __('Manage Bloggers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Bloggers'));

        return $resultPage;
    }

    /**
     * Acl check for admin
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Raccoon_Bloggers::bloggers');
    }
}
?>