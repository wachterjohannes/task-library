<?php

namespace Asapo\Tasks\InMemory;

use Tasks\Scheduler\SchedulerInterface;
use Tasks\Scheduler\TaskInterface;

class Scheduler implements SchedulerInterface
{
    /**
     * @var TaskRunner
     */
    private $taskRunner;

    public function __construct(TaskRunner $taskRunner)
    {
        $this->taskRunner = $taskRunner;
    }

    public function schedule(TaskInterface $task)
    {
        $this->taskRunner->addTask($task);
    }

    public function run(TaskInterface $task)
    {
        return $this->taskRunner->runImmediately($task);
    }
}
