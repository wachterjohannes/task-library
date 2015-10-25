<?php

namespace Asapo\Tasks\Gearman;

use GearmanJob;
use GearmanWorker;
use Tasks\NamingFactoryInterface;
use Tasks\TaskInterface;
use Tasks\WorkerInterface;
use Tasks\TaskRunnerInterface;

class TaskRunner implements TaskRunnerInterface
{
    /**
     * @var NamingFactoryInterface
     */
    private $namingFactory;

    /**
     * @var GearmanWorker
     */
    private $gearmanWorker;

    public function __construct(GearmanWorker $gearmanWorker, NamingFactoryInterface $namingFactory)
    {
        $this->namingFactory = $namingFactory;
        $this->gearmanWorker = $gearmanWorker;
    }

    public function addWorker(WorkerInterface $worker)
    {
        $this->gearmanWorker->addFunction(
            $this->namingFactory->fromWorker($worker),
            function (GearmanJob $job) use ($worker) {
                /** @var TaskInterface $task */
                $task = unserialize($job->workload());

                return $worker->run($task);
            }
        );
    }

    public function run()
    {
        while ($this->gearmanWorker->work()) {
            if ($this->gearmanWorker->returnCode() != GEARMAN_SUCCESS) {
                // TODO log
            }
        }
    }
}
