<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magepow\ProductTags\Ui\Component\Listing\Column;

class TagActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /** Url path */
    const URL_PATH_EDIT = 'magepow_producttags/tag/edit';
    const URL_PATH_DELETE = 'magepow_producttags/tag/delete';

    /**
     * @var \Magepow\ProductTags\Block\Adminhtml\Tags\Grid\Renderer\Action\UrlBuilder
     */
    protected $actionUrlBuilder;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder $actionUrlBuilder
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
         \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magepow\ProductTags\Block\Adminhtml\Tags\Grid\Renderer\Action\UrlBuilder $actionUrlBuilder,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::URL_PATH_EDIT
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['tag_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['tag_id' => $item['tag_id']]),
                        'label' => __('Edit')
                    ];
                    $escaper = \Magento\Framework\App\ObjectManager::getInstance()
                                ->get(\Magento\Framework\Escaper::class);
                    $title = $escaper->escapeHtml($item['tag_title']);
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['tag_id' => $item['tag_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $title),
                            'message' => __('Are you sure you want to delete a %1 record?', $title)
                        ],
                        'post' => true
                    ];
                }
            }
        }

        return $dataSource;
    }
}
