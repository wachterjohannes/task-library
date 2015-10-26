<?php

namespace Asapo\Tasks\Database\InMemory;

use Serializable;
use Tasks\Scheduler\TaskInterface;

class InMemoryTask implements TaskInterface
{
    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * @var bool
     */
    private $completed = false;

    /**
     * @var string|Serializable
     */
    private $result;

    public function __construct(TaskInterface $task)
    {
        $this->task = $task;
    }

    /**
     * {@inheritdoc}
     */
    public function getWorkerName()
    {
        return $this->task->getWorkerName();
    }

    /**
     * {@inheritdoc}
     */
    public function getWorkload()
    {
        return $this->task->getWorkload();
    }

    /**
     * @return boolean
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    public function setCompleted($result)
    {
        $this->completed = true;
        $this->result = $result;

        return $this->completed;
    }

    public function getTask()
    {
        return $this->task;
    }

    /**
     * @return Serializable|string
     */
    public function getResult()
    {
        return $this->result;
    }
}
