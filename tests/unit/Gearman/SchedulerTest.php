<?php

namespace Unit\Gearman;

use Asapo\Tasks\Gearman\Scheduler;
use GearmanClient;
use Tasks\Naming\NamingFactoryInterface;
use Tasks\Scheduler\TaskInterface;

class SchedulerTest extends \PHPUnit_Framework_TestCase
{
    public function testSchedule()
    {
        $task = $this->prophesize(TaskInterface::class);
        $namingFactory = $this->prophesize(NamingFactoryInterface::class);
        $namingFactory->fromTask($task->reveal())->shouldBeCalled()->willReturn('test.worker');
        $gearmanClient = $this->prophesize(GearmanClient::class);
        $gearmanClient->doBackground('test.worker', serialize($task->reveal()))->shouldBeCalledTimes(1);

        $scheduler = new Scheduler($gearmanClient->reveal(), $namingFactory->reveal());
        $scheduler->schedule($task->reveal());
    }

    public function testRun()
    {
        $task = $this->prophesize(TaskInterface::class);
        $namingFactory = $this->prophesize(NamingFactoryInterface::class);
        $namingFactory->fromTask($task->reveal())->shouldBeCalled()->willReturn('test.worker');
        $gearmanClient = $this->prophesize(GearmanClient::class);
        $gearmanClient->doNormal('test.worker', serialize($task->reveal()))
            ->shouldBeCalledTimes(1)
            ->willReturn('test-result');

        $scheduler = new Scheduler($gearmanClient->reveal(), $namingFactory->reveal());
        $result = $scheduler->run($task->reveal());

        $this->assertEquals('test-result', $result);
    }
}
