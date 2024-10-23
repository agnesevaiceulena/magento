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
use Magento\Framework\Controller\Result\RedirectFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Api\Data\QuestionInterfaceFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Save extends Action
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * @var QuestionInterfaceFactory
     */
    protected $questionFactory;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * Constructor.
     *
     * @param Action\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param QuestionInterfaceFactory $questionFactory
     * @param DateTime $date
     */
    public function __construct(
        Action\Context $context,
        QuestionRepositoryInterface $questionRepository,
        QuestionInterfaceFactory $questionFactory,
        DateTime $date
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
        $this->questionFactory = $questionFactory;
        $this->date = $date;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
    }

    /**
     * Execute save action.
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('id');

            try {
                $id = (int) $this->getRequest()->getParam('id');
                $date = $this->date->gmtDate();
                $postData = array(
                    'question' => $data['question'],
                    'answer' => $data['answer'],
                    'status' => $data['status'],
                    'updated_at' => $date
                );

                if ($id) {
                    $question = $this->questionRepository->getById($id);
                    $question->setQuestion($postData['question']);
                    $question->setAnswer($postData['answer']);
                    $question->setStatus((int) $postData['status']);
                    $question->setUpdatedAt($postData['updated_at']);
                } else {
                    $question = $this->questionFactory->create();
                    $question->setData($postData);
                }

                $this->questionRepository->save($question);

                $this->messageManager->addSuccessMessage(__('The question has been saved.'));

                if ($this->getRequest()->getParam('back') === 'close') {
                    return $resultRedirect->setPath('*/*/index');
                }

                return $resultRedirect->setPath('*/*/edit', ['id' => $question->getId(), '_current' => true]);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while saving the question.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
