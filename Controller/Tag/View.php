<?php

namespace Magepow\ProductTags\Controller\Tag;

class View extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magepow\ProductTags\Model\TagFactory $tagModelFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magepow\ProductTags\Model\TagFactory $tagModelFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_tagModelFactory = $tagModelFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {   
        $tag = $this->_initTag();

        if ($tag && $tag->getStatus()) {
            $page = $this->resultPageFactory->create();
            $page->addHandle(['type' => 'MAGEPOW_PRODUCTTAGS_'.$tag->getId()]);
            $page->getConfig()->addBodyClass('page-products')
            ->addBodyClass('tag-' . $tag->getIdentifier());
            return $page;
        }elseif (!$this->getResponse()->isRedirect()) {
            return $this->resultForwardFactory->create()->forward('noroute');
        }
    }
    public function _initTag()
    {   

        $tagModel = $this->_tagModelFactory->create();
        $tagId = (int)$this->getRequest()->getParam('tag_id', false);
        if($tagId){
            $tagModel->load($tagId);
        } else{
            $tagCode = $this->getRequest()->getParam('tag_code', false);
            $tagCode = trim($tagCode);
            if (!$tagCode) {
                return false;
            }
            $tagModel->loadByIdentifier($tagCode);
        }
        
        if($tagModel->getId()){
            $this->_coreRegistry->register('current_tag', $tagModel);
            return $tagModel;
        }
        
        return false;
    }
}
