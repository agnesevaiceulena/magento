<?php

namespace Magebit\Faq\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;

class Index extends Action
{
    protected $resultPageFactory;
    protected $questionRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->questionRepository = $questionRepository;
    }

    public function execute()
    {
        // Fetch all questions ordered by position
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Frequently Asked Questions'));

        return $resultPage;
    }
}
