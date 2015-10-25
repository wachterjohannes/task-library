<?php

namespace Asapo\Tasks\InMemory;

use Tasks\NamingFactoryInterface;
use Tasks\TaskInterface;
use Tasks\WorkerInterface;
use Tasks\TaskRunnerInterface;

class TaskRunner implements TaskRunnerInterface
{
    /**
     * @var NamingFactoryInterface
     */
    private $namingFactory;

    /**
     * @var TaskInterface[]
     */
    private $tasks = [];

    /**
     * @var WorkerInterface[]
     */
    private $worker = [];

    public function __construct(NamingFactoryInterface $namingFactory)
    {
        $this->namingFactory = $namingFactory;
    }

    public function addWorker(WorkerInterface $worker)
    {
        $this->worker[$this->namingFactory->fromWorker($worker)] = $worker;
    }

    public function addTask(TaskInterface $task)
    {
        $this->tasks[] = $task;
    }

    public function run()
    {
        foreach ($this->tasks as $task) {
            $this->worker[$this->namingFactory->fromTask($task)]->run($task);
        }
    }

    public function runImmediately(TaskInterface $task)
    {
        return $this->worker[$this->namingFactory->fromTask($task)]->run($task);
    }
}
