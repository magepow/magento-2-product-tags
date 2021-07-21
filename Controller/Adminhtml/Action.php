<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);
namespace Magepow\ProductTags\Controller\Adminhtml;
use Magento\Store\Model\Store;
/**
 * Catalog Action controller
 */
abstract class Action extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Magepow_ProductTags::Tag';
    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date|null $dateFilter
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter = null
    ) {
        $this->dateFilter = $dateFilter;
        parent::__construct($context);
    }
    /**
     * Initialize requested category and put it into registry.
     * Root category can be returned, if inappropriate store/category is specified
     *
     * @return \Magepow\ProductTags\Model\Tag|false
     */
    protected function _initTag()
    {
        $tagId = (int)$this->getRequest()->getParam('tag_id', false);
        $storeId = (int)$this->getRequest()->getParam('store', false);
        $tag = $this->_objectManager->create(\Magepow\ProductTags\Model\Tag::class);
        if ($tagId) {
            $tag->load($tagId);
        }
        $coreRegistry = $this->_objectManager->get(\Magento\Framework\Registry::class);
        $coreRegistry->register('tag', $tag);
        $coreRegistry->register('current_tag', $tag);
        $this->_objectManager->get(\Magento\Cms\Model\Wysiwyg\Config::class)
            ->setStoreId($storeId);
        return $tag;
    }
}