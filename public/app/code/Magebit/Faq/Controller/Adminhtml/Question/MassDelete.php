<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class MassDelete extends Action
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
            $this->messageManager->addErrorMessage(__('Please select questions to delete.'));
            return $this->_redirect('*/*/index');
        }

        try {
            foreach ($selected as $questionId) {
                $this->questionRepository->deleteById($questionId);
            }
            $this->messageManager->addSuccessMessage(__('Selected questions have been deleted.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while deleting the questions.'));
        }

        return $this->_redirect('*/*/index');
    }
}
