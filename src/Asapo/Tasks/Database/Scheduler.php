<?php

namespace Asapo\Tasks\Database;

use Tasks\SchedulerInterface;
use Tasks\TaskInterface;

class Scheduler implements SchedulerInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * @var TaskRunner
     */
    private $taskRunner;

    public function __construct(TaskRepositoryInterface $taskRepository, TaskRunner $taskRunner)
    {
        $this->taskRepository = $taskRepository;
        $this->taskRunner = $taskRunner;
    }

    public function schedule(TaskInterface $task)
    {
        $this->taskRepository->persist($task);
    }

    public function run(TaskInterface $task)
    {
        return $this->taskRunner->runImmediately($task);
    }
}
