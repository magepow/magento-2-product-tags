<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magepow\ProductTags\Controller\Adminhtml\Tag;

use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends \Magepow\ProductTags\Controller\Adminhtml\Action implements HttpPostActionInterface
{   
    protected $_tagFactory;

    protected $_tagCollectionFactory;
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magepow\ProductTags\Model\TagFactory $tagFactory,
        \Magepow\ProductTags\Model\ResourceModel\Tag\CollectionFactory $tagCollectionFactory,
        \Magento\Backend\Helper\Js $jsHelper
    ) {
        parent::__construct($context);
        $this->_resultRedirectFactory = $context->getResultRedirectFactory();
        $this->_tagFactory = $tagFactory;
        $this->_tagCollectionFactory = $tagCollectionFactory;
    }
     public function execute()
    {
        $id = $this->getRequest()->getParam('tag_id');
        try {
            $item = $this->_tagFactory->create()->setId($id);
            $item->delete();
            $this->messageManager->addSuccess(
                __('Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
