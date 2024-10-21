<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;

class MassEnable extends Action
{
    protected $questionRepository;

    public function __construct(
        Action\Context $context,
        \Magebit\Faq\Api\QuestionRepositoryInterface $questionRepository
    ) {
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $selected = $this->getRequest()->getParam('selected', []);
        foreach ($selected as $questionId) {
            $question = $this->questionRepository->getById($questionId);
            $question->setStatus(1);
            $this->questionRepository->save($question);
        }

        $this->messageManager->addSuccessMessage(__('Selected questions were enabled.'));
        return $this->_redirect('*/*/index');
    }
}
