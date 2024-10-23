<?php
/**
 * This file is part of the Magebit_PageListWidget package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_PageListWidget
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com/>
 * @license   MIT
 */

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Cms\Model\ResourceModel\Page\Collection;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PageList extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = 'Magebit_PageListWidget::widget/pagelist.phtml';

    /**
     * @var Collection
     */
    protected $pageCollection;

    /**
     * PageList constructor.
     *
     * @param Template\Context $context
     * @param Collection $pageCollection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Collection $pageCollection,
        array $data = []
    ) {
        $this->pageCollection = $pageCollection;
        parent::__construct($context, $data);
    }

    /**
     * Get widget title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * Get the list of CMS pages.
     *
     * @return Collection
     */
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
