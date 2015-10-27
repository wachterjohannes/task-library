<?php

namespace Unit\Gearman;

use Asapo\Tasks\Gearman\TaskRunner;
use GearmanWorker;
use Tasks\Naming\NamingFactoryInterface;
use Tasks\TaskRunner\WorkerInterface;

class TaskRunnerTest extends \PHPUnit_Framework_TestCase
{
    public function testAddWorker()
    {
        $worker = $this->prophesize(WorkerInterface::class);
        $worker->addFunction('test.worker');
        $namingFactory = $this->prophesize(NamingFactoryInterface::class);
        $gearmanWorker = $this->prophesize(GearmanWorker::class);

        $taskRunner = new TaskRunner($gearmanWorker->reveal(), $namingFactory->reveal());
        $taskRunner->addWorker($worker->reveal());
    }

    public function testRun()
    {
        // TODO test run gearman task runner
    }
}
