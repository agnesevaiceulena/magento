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

namespace Magebit\Faq\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;

/**
 * Class Index
 *
 * Displays the FAQ page with a list of questions.
 */
class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * Constructor.
     *
     * @param PageFactory $resultPageFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        PageFactory $resultPageFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Execute method.
     *
     * Renders the FAQ page.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Frequently Asked Questions'));

        return $resultPage;
    }
}
