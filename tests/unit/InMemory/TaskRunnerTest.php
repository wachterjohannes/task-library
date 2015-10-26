<?php

namespace Unit\InMemory;

use Asapo\Tasks\InMemory\TaskRunner;
use Tasks\Naming\NamingFactory;
use Tasks\Scheduler\TaskInterface;
use Tasks\TaskRunner\WorkerInterface;

class TaskRunnerTest extends \PHPUnit_Framework_TestCase
{
    public function testAddWorker()
    {
        $worker = $this->prophesize(WorkerInterface::class);
        $namingFactory = $this->prophesize(NamingFactory::class);
        $namingFactory->fromWorker($worker->reveal())->willReturn('tests.worker');

        $taskRunner = new TaskRunner($namingFactory->reveal());

        $taskRunner->addWorker($worker->reveal());

        $classReflection = new \ReflectionClass($taskRunner);
        $propertyReflection = $classReflection->getProperty('worker');
        $propertyReflection->setAccessible(true);

        $this->assertContains($worker->reveal(), $propertyReflection->getValue($taskRunner));
    }

    public function testAddTask()
    {
        $task = $this->prophesize(TaskInterface::class);
        $namingFactory = $this->prophesize(NamingFactory::class);
        $namingFactory->fromTask($task->reveal())->willReturn('tests.worker');

        $taskRunner = new TaskRunner($namingFactory->reveal());

        $taskRunner->addTask($task->reveal());

        $classReflection = new \ReflectionClass($taskRunner);
        $propertyReflection = $classReflection->getProperty('tasks');
        $propertyReflection->setAccessible(true);

        $this->assertContains($task->reveal(), $propertyReflection->getValue($taskRunner));
    }

    public function testRun()
    {
        $task = $this->prophesize(TaskInterface::class);
        $worker = $this->prophesize(WorkerInterface::class);
        $worker->run($task->reveal())->shouldBeCalledTimes(1);
        $namingFactory = $this->prophesize(NamingFactory::class);
        $namingFactory->fromTask($task->reveal())->willReturn('tests.worker');
        $namingFactory->fromWorker($worker->reveal())->willReturn('tests.worker');

        $taskRunner = new TaskRunner($namingFactory->reveal());
        $taskRunner->addWorker($worker->reveal());
        $taskRunner->addTask($task->reveal());

        $taskRunner->run();
    }

    public function testRunMultipleWorker()
    {
        $task1 = $this->prophesize(TaskInterface::class);
        $task2 = $this->prophesize(TaskInterface::class);
        $worker1 = $this->prophesize(WorkerInterface::class);
        $worker2 = $this->prophesize(WorkerInterface::class);
        $worker1->run($task1->reveal())->shouldBeCalledTimes(1);
        $worker2->run($task2->reveal())->shouldBeCalledTimes(1);
        $namingFactory = $this->prophesize(NamingFactory::class);
        $namingFactory->fromTask($task1->reveal())->willReturn('tests.worker1');
        $namingFactory->fromTask($task2->reveal())->willReturn('tests.worker2');
        $namingFactory->fromWorker($worker1->reveal())->willReturn('tests.worker1');
        $namingFactory->fromWorker($worker2->reveal())->willReturn('tests.worker2');

        $taskRunner = new TaskRunner($namingFactory->reveal());
        $taskRunner->addWorker($worker1->reveal());
        $taskRunner->addWorker($worker2->reveal());
        $taskRunner->addTask($task1->reveal());
        $taskRunner->addTask($task2->reveal());

        $taskRunner->run();
    }

    public function testRunMultipleTasks()
    {
        $task1 = $this->prophesize(TaskInterface::class);
        $task2 = $this->prophesize(TaskInterface::class);
        $worker = $this->prophesize(WorkerInterface::class);
        $worker->run($task1->reveal())->shouldBeCalledTimes(1);
        $worker->run($task2->reveal())->shouldBeCalledTimes(1);
        $namingFactory = $this->prophesize(NamingFactory::class);
        $namingFactory->fromTask($task1->reveal())->willReturn('tests.worker');
        $namingFactory->fromTask($task2->reveal())->willReturn('tests.worker');
        $namingFactory->fromWorker($worker->reveal())->willReturn('tests.worker');

        $taskRunner = new TaskRunner($namingFactory->reveal());
        $taskRunner->addWorker($worker->reveal());
        $taskRunner->addTask($task1->reveal());
        $taskRunner->addTask($task2->reveal());

        $taskRunner->run();
    }
}
