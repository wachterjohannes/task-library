<?php

namespace Asapo\Tasks\Database;

use Tasks\Scheduler\TaskInterface;

interface TaskRepositoryInterface
{
    public function findAll();

    public function findInCompleted();

    public function persist(TaskInterface $task);

    public function markCompleted(TaskInterface $task, $result);
}
