<?php
/**
 * This file is part of the Magebit_BackOrder package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_BackOrder
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com/>
 * @license   MIT
 */
declare(strict_types=1);

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\UrlInterface;

class Delete implements ButtonProviderInterface
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Context
     */
    protected $context;

    /**
     * Constructor.
     *
     * @param UrlInterface $urlBuilder
     * @param Context $context
     */
    public function __construct(UrlInterface $urlBuilder, Context $context)
    {
        $this->urlBuilder = $urlBuilder;
        $this->context = $context;
    }

    /**
     * Get configuration for the Delete button.
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $id = $this->getQuestionId();
        if ($id) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to delete this FAQ?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Get current FAQ id.
     *
     * @return int|null
     */
    protected function getQuestionId()
    {
        return (int) $this->context->getRequestParam('id');
    }

    /**
     * Get URL for delete action.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->urlBuilder->getUrl('*/*/delete', ['id' => $this->getQuestionId()]);
    }
}
