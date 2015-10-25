<?php

namespace Asapo\Tasks\Gearman;

use GearmanJob;
use GearmanWorker;
use Tasks\NamingFactoryInterface;
use Tasks\TaskInterface;
use Tasks\WorkerInterface;
use Tasks\WorkerManagerInterface;

class WorkerManager implements WorkerManagerInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var NamingFactoryInterface
     */
    private $namingFactory;

    /**
     * @var GearmanWorker
     */
    private $gearmanWorker;

    public function __construct(NamingFactoryInterface $namingFactory, $host = '127.0.0.1', $port = 4730)
    {
        $this->namingFactory = $namingFactory;
        $this->host = $host;
        $this->port = $port;

        $this->gearmanWorker = new GearmanWorker();
        $this->gearmanWorker->addServer($this->host, $this->port);
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
