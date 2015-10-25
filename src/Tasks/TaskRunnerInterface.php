<?php

namespace Tasks;

interface TaskRunnerInterface
{
    public function addWorker(WorkerInterface $worker);

    public function run();
}
