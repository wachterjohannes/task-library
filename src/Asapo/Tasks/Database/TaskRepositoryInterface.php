<?php

namespace Asapo\Tasks\Database;

use Tasks\TaskInterface;

interface TaskRepositoryInterface
{
    public function findAll();

    public function persist(TaskInterface $task);
}
