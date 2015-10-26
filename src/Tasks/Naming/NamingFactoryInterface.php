<?php

namespace Tasks\Naming;

use Tasks\Scheduler\TaskInterface;
use Tasks\TaskRunner\WorkerInterface;

interface NamingFactoryInterface
{
    public function fromWorker(WorkerInterface $worker);

    public function fromTask(TaskInterface $task);
}
