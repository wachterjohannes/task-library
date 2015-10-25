<?php

namespace Tasks;

interface SchedulerInterface
{
    public function schedule(TaskInterface $task);

    public function run(TaskInterface $task);
}
