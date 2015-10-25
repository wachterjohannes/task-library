<?php

namespace Asapo\Tasks\Gearman;

use GearmanClient;
use Tasks\NamingFactoryInterface;
use Tasks\SchedulerInterface;
use Tasks\TaskInterface;

class Scheduler implements SchedulerInterface
{
    /**
     * @var string
     */
    private $host = '127.0.0.1';

    /**
     * @var int
     */
    private $port = 4730;

    /**
     * @var NamingFactoryInterface
     */
    private $namingFactory;

    /**
     * @var GearmanClient
     */
    private $gearmanClient;

    public function __construct(NamingFactoryInterface $namingFactory, $host = '127.0.0.1', $port = 4730)
    {
        $this->namingFactory = $namingFactory;
        $this->host = $host;
        $this->port = $port;

        $this->gearmanClient = new GearmanClient();
        $this->gearmanClient->addServer($this->host, $this->port);
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
