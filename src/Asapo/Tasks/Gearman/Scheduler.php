<?php

namespace Asapo\Tasks\Gearman;

use GearmanClient;
use Tasks\Naming\NamingFactoryInterface;
use Tasks\Scheduler\SchedulerInterface;
use Tasks\Scheduler\TaskInterface;

class Scheduler implements SchedulerInterface
{
    /**
     * @var NamingFactoryInterface
     */
    private $namingFactory;

    /**
     * @var GearmanClient
     */
    private $gearmanClient;

    public function __construct(GearmanClient $gearmanClient, NamingFactoryInterface $namingFactory)
    {
        $this->namingFactory = $namingFactory;
        $this->gearmanClient = $gearmanClient;
    }

    public function schedule(TaskInterface $task)
    {
        $this->gearmanClient->doBackground($this->namingFactory->fromTask($task), serialize($task));
    }

    public function run(TaskInterface $task)
    {
        return $this->gearmanClient->doNormal($this->namingFactory->fromTask($task), serialize($task));
    }
}
