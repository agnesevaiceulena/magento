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

namespace Magebit\Faq\Api\Data;

/**
 * Interface for Question data model.
 *
 * This interface defines the getters and setters for the Question entity,
 * which includes the question text, answer, status, position, and timestamps.
 */
interface QuestionInterface
{
    /**#@+
     * Constants for keys of data array.
     */
    const ID = 'id';
    const QUESTION = 'question';
    const ANSWER = 'answer';
    const STATUS = 'status';
    const POSITION = 'position';
    const UPDATED_AT = 'updated_at';
    /**#@-*/

    /**
     * Get question ID.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get question text.
     *
     * @return string|null
     */
    public function getQuestion();

    /**
     * Set question text.
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion($question);

    /**
     * Get answer text.
     *
     * @return string|null
     */
    public function getAnswer();

    /**
     * Set answer text.
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer($answer);

    /**
     * Get question status.
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Set question status.
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get position of the question.
     *
     * @return int|null
     */
    public function getPosition();

    /**
     * Set position of the question.
     *
     * @param int $position
     * @return $this
     */
    public function setPosition($position);

    /**
     * Get the last updated timestamp.
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set the last updated timestamp.
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}
