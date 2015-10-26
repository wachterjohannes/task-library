<?php

namespace Asapo\Tasks\Database\InMemory;

use Asapo\Tasks\Database\TaskRepositoryInterface;
use Tasks\Scheduler\TaskInterface;

class InMemoryTaskRepository implements TaskRepositoryInterface
{
    /**
     * @var InMemoryTask[]
     */
    private $tasks = [];

    public function findAll()
    {
        return array_values(
            array_map(function (InMemoryTask $task) {
                return $task->getTask();
            }, $this->tasks)
        );
    }

    public function findInCompleted()
    {
        return array_values(
            array_map(
                function (InMemoryTask $task) {
                    return $task->getTask();
                },
                array_filter(
                    $this->tasks,
                    function (InMemoryTask $task) {
                        return !$task->isCompleted();
                    }
                )
            )
        );
    }

    public function persist(TaskInterface $task)
    {
        $this->tasks[spl_object_hash($task)] = new InMemoryTask($task);
    }

    public function markCompleted(TaskInterface $task, $result)
    {
        $this->tasks[spl_object_hash($task)]->setCompleted($result);
    }
}
