<?php

namespace Tasks;

interface WorkerManagerInterface
{
    public function addWorker(WorkerInterface $worker);

    public function run();
}
