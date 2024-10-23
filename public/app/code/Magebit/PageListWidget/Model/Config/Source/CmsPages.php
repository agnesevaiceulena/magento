<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com/>
 * @license   MIT
 */

namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Model\ResourceModel\Page\Collection;

class CmsPages implements OptionSourceInterface
{
    /**
     * @var Collection
     */
    protected $pageCollection;

    /**
     * CmsPages constructor.
     *
     * @param Collection $pageCollection
     */
    public function __construct(Collection $pageCollection)
    {
        $this->pageCollection = $pageCollection;
    }

    /**
     * Get list of CMS pages as option array.
     *
     * @return array
     */
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
