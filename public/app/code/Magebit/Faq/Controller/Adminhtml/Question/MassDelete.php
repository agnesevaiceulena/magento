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

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class MassDelete extends Action
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * Constructor.
     *
     * @param Action\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     */
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
