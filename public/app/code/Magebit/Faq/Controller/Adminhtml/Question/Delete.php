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
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\RedirectFactory;

class Delete extends Action
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
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
    }

    /**
     * Execute delete action.
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $this->questionRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The FAQ has been deleted.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while deleting the FAQ.'));
            }
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
