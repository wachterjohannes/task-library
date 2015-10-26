<?php

namespace Tasks\Scheduler;

interface SchedulerInterface
{
    public function schedule(TaskInterface $task);

    public function run(TaskInterface $task);
}
