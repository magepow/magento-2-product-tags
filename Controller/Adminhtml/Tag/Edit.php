<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magepow\ProductTags\Controller\Adminhtml\Tag;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends \Magepow\ProductTags\Controller\Adminhtml\Action implements HttpGetActionInterface
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
    public function execute()
    {
        $tag = $this->_initTag();
        $id = $tag->getId();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create()->setActiveMenu('Magepow_ProductTags::producttags')
                    ->addBreadcrumb(__('Product Tags'), __('Product Tags'))
                    ->addBreadcrumb(__('Manage Tags'), __('Manage Tags'))
                    ->addBreadcrumb(
                        $id ? __('Edit Tag') : __('New Tag'),
                        $id ? __('Edit Tag') : __('New Tag')
                    );
        $resultPage->getConfig()->getTitle()->prepend(__('Tags'));
        $resultPage->getConfig()->getTitle()
            ->prepend($tag->getId() ? $tag->getTagTitle() : __('New Tag'));
        return $resultPage;
    }
}