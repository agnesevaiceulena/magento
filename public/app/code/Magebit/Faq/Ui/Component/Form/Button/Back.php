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

class Back implements ButtonProviderInterface
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
     * Get configuration for the Back button.
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10,
        ];
    }

    /**
     * Get URL for the back action.
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->urlBuilder->getUrl('*/*/');
    }
}
