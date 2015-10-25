<?php

namespace Tasks;

class NamingFactory implements NamingFactoryInterface
{
    public function fromWorker(WorkerInterface $worker)
    {
        return sprintf('%s.%s', $worker->getNamespace(), $worker->getName());
    }

    public function fromTask(TaskInterface $task)
    {
        return $task->getWorkerName();
    }
}
