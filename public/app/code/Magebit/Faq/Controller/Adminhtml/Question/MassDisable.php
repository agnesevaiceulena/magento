<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class MassDisable extends Action
{
    protected $questionRepository;

    public function __construct(
        Action\Context $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $selected = $this->getRequest()->getParam('selected', []);

        if (empty($selected)) {
            $this->messageManager->addErrorMessage(__('Please select questions to disable.'));
            return $this->_redirect('*/*/index');
        }

        try {
            foreach ($selected as $questionId) {
                $question = $this->questionRepository->getById($questionId);
                $question->setStatus(0);
                $this->questionRepository->save($question);
            }
            $this->messageManager->addSuccessMessage(__('Selected questions have been disabled.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while disabling the questions.'));
        }

        return $this->_redirect('*/*/index');
    }
}
