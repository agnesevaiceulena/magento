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
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */
declare(strict_types=1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends Action implements HttpGetActionInterface
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
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Edit FAQ question.
     *
     * @return \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\Result\Redirect
     */
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
