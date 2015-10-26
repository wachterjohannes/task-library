<?php

namespace Unit\InMemory;

use Asapo\Tasks\InMemory\Scheduler;
use Asapo\Tasks\InMemory\TaskRunner;
use Tasks\Scheduler\TaskInterface;

/**
 * @group unit
 */
class SchedulerTest extends \PHPUnit_Framework_TestCase
{
    public function testSchedule()
    {
        $taskRunner = $this->prophesize(TaskRunner::class);
        $task = $this->prophesize(TaskInterface::class);
        $taskRunner->addTask($task->reveal())->shouldBeCalled();

        $scheduler = new Scheduler($taskRunner->reveal());
        $scheduler->schedule($task->reveal());
    }

    public function testRun()
    {
        $taskRunner = $this->prophesize(TaskRunner::class);
        $task = $this->prophesize(TaskInterface::class);
        $taskRunner->runImmediately($task->reveal())->shouldBeCalled();

        $scheduler = new Scheduler($taskRunner->reveal());
        $scheduler->run($task->reveal());
    }
}
