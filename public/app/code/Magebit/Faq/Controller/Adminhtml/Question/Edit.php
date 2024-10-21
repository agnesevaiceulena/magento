<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends Action implements HttpGetActionInterface
{
    protected $resultPageFactory;
    protected $questionRepository;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->questionRepository = $questionRepository;
    }

    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('id');

        if ($id) {
            try {
                $question = $this->questionRepository->getById($id);

                if (!$question->getId()) {
                    $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                    return $this->resultRedirectFactory->create()->setPath('*/*/');
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error while trying to load the question.'));
                return $this->resultRedirectFactory->create()->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('FAQ Question'));

        return $resultPage;
    }
}
