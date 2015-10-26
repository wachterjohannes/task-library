<?php

namespace Tasks\TaskRunner;

use Tasks\Scheduler\TaskInterface;

interface ImmediatelyTaskRunnerInterface extends TaskRunnerInterface
{
    public function runImmediately(TaskInterface $task);
}
