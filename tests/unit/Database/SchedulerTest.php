<?php

namespace Unit\InMemory;

use Asapo\Tasks\Database\Scheduler;
use Asapo\Tasks\Database\TaskRepositoryInterface;
use Asapo\Tasks\Database\TaskRunner;
use Tasks\Scheduler\TaskInterface;

/**
 * @group unit
 */
class SchedulerTest extends \PHPUnit_Framework_TestCase
{
    public function testSchedule()
    {
        $repository = $this->prophesize(TaskRepositoryInterface::class);
        $taskRunner = $this->prophesize(TaskRunner::class);
        $task = $this->prophesize(TaskInterface::class);
        $repository->persist($task->reveal())->shouldBeCalledTimes(1);

        $scheduler = new Scheduler($repository->reveal(), $taskRunner->reveal());
        $scheduler->schedule($task->reveal());
    }

    public function testRun()
    {
        $repository = $this->prophesize(TaskRepositoryInterface::class);
        $taskRunner = $this->prophesize(TaskRunner::class);
        $task = $this->prophesize(TaskInterface::class);
        $taskRunner->runImmediately($task->reveal())->shouldBeCalledTimes(1);

        $scheduler = new Scheduler($repository->reveal(), $taskRunner->reveal());
        $scheduler->run($task->reveal());
    }
}
