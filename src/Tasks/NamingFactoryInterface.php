<?php

namespace Tasks;

interface NamingFactoryInterface
{
    public function fromWorker(WorkerInterface $worker);

    public function fromTask(TaskInterface $task);
}
