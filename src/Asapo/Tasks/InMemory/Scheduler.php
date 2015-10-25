<?php

namespace Asapo\Tasks\InMemory;

use Tasks\SchedulerInterface;
use Tasks\TaskInterface;

class Scheduler implements SchedulerInterface
{
    /**
     * @var TaskRunner
     */
    private $workerManager;

    public function __construct(TaskRunner $workerManager)
    {
        $this->workerManager = $workerManager;
    }

    public function schedule(TaskInterface $task)
    {
        $this->workerManager->addTask($task);
    }

    public function run(TaskInterface $task)
    {
        return $this->workerManager->runImmediately($task);
    }
}