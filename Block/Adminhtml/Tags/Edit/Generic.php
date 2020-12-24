<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magepow\ProductTags\Block\Adminhtml\Tags\Edit;

use Magento\Backend\Block\Widget\Context;
use Magepow\ProductTags\Api\TagRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magepow\ProductTags\Model\TagFactory;

/**
 * Class GenericButton
 */
class Generic
{
    protected $context;
    protected $tagRepository;
    protected $TagFactory;
    public function __construct(
        Context $context,
        TagFactory $TagFactory,
        TagRepositoryInterface $tagRepository
    ) {
        $this->context = $context;
        $this->TagFactory = $TagFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(TagFactory::class);
        $this->tagRepository = $tagRepository;
    }
    public function getTagId()
    {
        try {
            return $this->tagRepository->getById($this->context->getRequest()->getParam('tag_name'))->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
