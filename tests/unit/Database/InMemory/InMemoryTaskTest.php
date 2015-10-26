<?php

namespace Unit\Database\InMemory;

use Asapo\Tasks\Database\InMemory\InMemoryTask;
use Tasks\Scheduler\TaskInterface;

class InMemoryTaskTest extends \PHPUnit_Framework_TestCase
{
    public function testGetWorkerName()
    {
        $task = $this->prophesize(TaskInterface::class);
        $task->getWorkerName()->willReturn('example.worker');

        $inMemoryTask = new InMemoryTask($task->reveal());
        $this->assertEquals('example.worker', $inMemoryTask->getWorkerName());
    }

    public function testGetWorkload()
    {
        $task = $this->prophesize(TaskInterface::class);
        $task->getWorkload()->willReturn('workload');

        $inMemoryTask = new InMemoryTask($task->reveal());
        $this->assertEquals('workload', $inMemoryTask->getWorkload());
    }

    public function testGetTask()
    {
        $task = $this->prophesize(TaskInterface::class);

        $inMemoryTask = new InMemoryTask($task->reveal());
        $this->assertEquals($task->reveal(), $inMemoryTask->getTask());
    }

    public function testSetCompleted()
    {
        $task = $this->prophesize(TaskInterface::class);

        $inMemoryTask = new InMemoryTask($task->reveal());
        $this->assertTrue($inMemoryTask->setCompleted('result'));
        $this->assertEquals('result', $inMemoryTask->getResult());
    }
}
