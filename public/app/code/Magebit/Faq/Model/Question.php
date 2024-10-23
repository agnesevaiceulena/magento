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

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel implements QuestionInterface
{
    /**
     * Define resource model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magebit\Faq\Model\ResourceModel\Question::class);
    }

    /**
     * Get ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get Question.
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * Set Question.
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * Get Answer.
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Set Answer.
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Get Status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set Status.
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get Position.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    /**
     * Set Position.
     *
     * @param int $position
     * @return $this
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * Get Updated At timestamp.
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set Updated At timestamp.
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
