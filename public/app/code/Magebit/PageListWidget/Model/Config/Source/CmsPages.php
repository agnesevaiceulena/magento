<?php

namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Model\ResourceModel\Page\Collection;

class CmsPages implements OptionSourceInterface
{
    protected $pageCollection;

    public function __construct(Collection $pageCollection)
    {
        $this->pageCollection = $pageCollection;
    }

    public function toOptionArray()
    {
        $options = [];
        $pages = $this->pageCollection->addFieldToSelect(['page_id', 'title']);

        foreach ($pages as $page) {
            $options[] = ['value' => $page->getId(), 'label' => $page->getTitle()];
        }

        return $options;
    }
}
