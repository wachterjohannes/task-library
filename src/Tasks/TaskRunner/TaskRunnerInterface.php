<?php

namespace Tasks\TaskRunner;

interface TaskRunnerInterface
{
    public function addWorker(WorkerInterface $worker);

    public function run();
}
