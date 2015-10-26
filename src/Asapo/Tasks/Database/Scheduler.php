<?php

namespace Asapo\Tasks\Database;

use Tasks\Scheduler\SchedulerInterface;
use Tasks\Scheduler\TaskInterface;
use Tasks\TaskRunner\ImmediatelyTaskRunnerInterface;

class Scheduler implements SchedulerInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * @var ImmediatelyTaskRunnerInterface
     */
    private $taskRunner;

    public function __construct(TaskRepositoryInterface $taskRepository, ImmediatelyTaskRunnerInterface $taskRunner)
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
