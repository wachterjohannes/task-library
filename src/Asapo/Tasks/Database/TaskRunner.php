<?php

namespace Asapo\Tasks\Database;


use Tasks\Naming\NamingFactoryInterface;
use Tasks\Scheduler\TaskInterface;
use Tasks\TaskRunner\TaskRunnerInterface;
use Tasks\TaskRunner\WorkerInterface;

class TaskRunner implements TaskRunnerInterface
{
    /**
     * @var NamingFactoryInterface
     */
    private $namingFactory;

    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * @var WorkerInterface[]
     */
    private $worker = [];

    public function __construct(TaskRepositoryInterface $taskRepository, NamingFactoryInterface $namingFactory)
    {
        $this->namingFactory = $namingFactory;
        $this->taskRepository = $taskRepository;
    }

    public function addWorker(WorkerInterface $worker)
    {
        $this->worker[$this->namingFactory->fromWorker($worker)] = $worker;
    }

    public function run()
    {
        foreach ($this->taskRepository->findAll() as $task) {
            $this->worker[$this->namingFactory->fromTask($task)]->run($task);
        }
    }

    public function runImmediately(TaskInterface $task)
    {
        return $this->worker[$this->namingFactory->fromTask($task)]->run($task);
    }
}
