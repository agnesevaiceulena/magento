<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Cms\Model\ResourceModel\Page\Collection;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PageList extends Template implements BlockInterface
{
    protected $_template = 'Magebit_PageListWidget::widget/pagelist.phtml';

    protected $pageCollection;

    public function __construct(
        Template\Context $context,
        Collection $pageCollection,
        array $data = []
    ) {
        $this->pageCollection = $pageCollection;
        parent::__construct($context, $data);
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function getPages()
    {
        $displayMode = $this->getData('display_mode');
        $pages = $this->pageCollection;

        if ($displayMode == 'specific') {
            $selectedPages = $this->getData('selected_pages');
            if ($selectedPages) {
                $pages->addFieldToFilter('page_id', ['in' => explode(',', $selectedPages)]);
            }
        }

        return $pages;
    }
}
