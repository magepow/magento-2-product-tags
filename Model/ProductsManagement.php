<?php

namespace Magepow\ProductTags\Model;

use Magepow\ProductTags\Api\TagsManagementInterface;
use Magepow\ProductTags\Model\ResourceModel\Tag as ResourceTag;
use Magepow\ProductTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;

class ProductsManagement implements \Magepow\ProductTags\Api\ProductsManagementInterface
{
    protected $resource;

    protected $tagFactory;

    protected $tagCollectionFactory;

    protected $searchResultsFactory;

    protected $dataTagFactory;

    /**
     * @var \Magepow\ProductTags\Api\Data\TagProductLinkInterfaceFactory
     */
    protected $productLinkFactory;

    /**
     * @param ResourceTag $resource
     * @param TagFactory $tagFactory
     * @param TagInterfaceFactory $dataTagFactory
     * @param TagCollectionFactory $tagCollectionFactory
     * @param \Magepow\ProductTags\Model\TagFactory $tagModelFactory
     * @param TagSearchResultsInterfaceFactory $searchResultsFactory
     * @param \Magepow\ProductTags\Api\Data\TagProductLinkInterfaceFactory $productLinkFactory
     */

    public function __construct(
        ResourceTag $resource,
        TagFactory $tagFactory,
        \Magepow\ProductTags\Api\Data\TagInterfaceFactory $dataTagFactory,
        TagCollectionFactory $tagCollectionFactory,
        \Magepow\ProductTags\Model\TagFactory $tagModelFactory,
        \Magepow\ProductTags\Api\Data\TagSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        \Magepow\ProductTags\Api\Data\TagProductLinkInterfaceFactory $productLinkFactory
    ) {
        $this->resource = $resource;
        $this->tagFactory = $tagFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_catalogProductVisibility = $catalogProductVisibility;
        $this->tagCollectionFactory = $tagCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataTagFactory = $dataTagFactory;
        $this->_tagModelFactory = $tagModelFactory;
        $this->productLinkFactory = $productLinkFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts($tagCode)
    {
        $tagModel = $this->_tagModelFactory->create();
        $tagModel->loadByIdentifier($tagCode);
        if (!$tagModel->getId()) {
            return [];
        }
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $products */
        $products = $tagModel->getProductCollection();
        /** @var \Magepow\ProductTags\Api\Data\TagProductLinkInterface[] $links */
        $links = [];
        if($products){
            /** @var \Magento\Catalog\Model\Product $product */
            foreach ($products->getItems() as $product) {
                /** @var \Magepow\ProductTags\Api\Data\TagProductLinkInterface $link */
                $link = $this->productLinkFactory->create();
                $link->setSku($product->getSku())
                    ->setPosition($product->getData('tag_index_position'))
                    ->setTagId($tagModel->getId());
                $links[] = $link;
            }
        }
        if($links){
            return $links;
        }
        return false;
    }
}
