<?php

namespace Unit\InMemory;

use Asapo\Tasks\Database\TaskRepositoryInterface;
use Asapo\Tasks\Database\TaskRunner;
use Tasks\Naming\NamingFactory;
use Tasks\TaskRunner\WorkerInterface;

/**
 * @group unit
 */
class TaskRunnerTest extends \PHPUnit_Framework_TestCase
{
    public function testAddWorker()
    {
        $repository = $this->prophesize(TaskRepositoryInterface::class);
        $worker = $this->prophesize(WorkerInterface::class);
        $namingFactory = $this->prophesize(NamingFactory::class);
        $namingFactory->fromWorker($worker->reveal())->willReturn('tests.worker');

        $taskRunner = new TaskRunner($repository->reveal(), $namingFactory->reveal());
        $taskRunner->addWorker($worker->reveal());

        $classReflection = new \ReflectionClass($taskRunner);
        $propertyReflection = $classReflection->getProperty('worker');
        $propertyReflection->setAccessible(true);

        $this->assertContains($worker->reveal(), $propertyReflection->getValue($taskRunner));
    }

    public function testRun()
    {
        // TODO test for TaskRunner::run
    }

    public function testRunImmediately()
    {
        // TODO test for TaskRunner::runImmediately
    }
}
