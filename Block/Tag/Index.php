<?php

namespace Magepow\ProductTags\Block\Tag;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $resultPageFactory;

    protected $_tagFactory;

    protected $_tagcollection;

    protected $_helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magepow\ProductTags\Model\TagFactory $tagFactory,
        \Magepow\ProductTags\Helper\Data $helper,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_tagFactory = $tagFactory;
        $this->_helper = $helper;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    /**
     * Prepare global layout
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        $page_title = $this->getCurrentTag()->getTagTitle();
        $meta_description = $this->getCurrentTag()->getTagDescription();
        $this->_addBreadcrumbs();
        if($page_title){
            $this->pageConfig->getTitle()->set($page_title);   
        }
        if($meta_description){
            $this->pageConfig->setDescription($meta_description);   
        }

        return parent::_prepareLayout();
    }

    public function getCurrentTag()
    {
        $tag = $this->_coreRegistry->registry('current_tag');
        if ($tag) {
            $this->setData('current_tag', $tag);
        }
        
        return $tag;
    }

     /**
     * Prepare breadcrumbs
     *
     * @param \Magento\Cms\Model\Page $brand
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return void
     */
    protected function _addBreadcrumbs()
    {
        $breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs');
        $baseUrl = $this->_storeManager->getStore()->getBaseUrl();
       
        if($breadcrumbsBlock)
        {
        $breadcrumbsBlock->addCrumb(
            'home',
            [
                'label' => __('Home'),
                'title' => __('Go to Home Page'),
                'link' => $baseUrl
            ]
            );
        
        $breadcrumbsBlock->addCrumb(
            'tag',
            [
                'label' => $this->getCurrentTag()->getTagTitle(),
                'title' => $this->getCurrentTag()->getTagTitle(),
                'link' => ''
            ]
            );
        }
    }
    /**
     * @return string
     */
    public function getProductListHtml()
    {
    	return $this->getChildHtml('list_product');
    }
}
