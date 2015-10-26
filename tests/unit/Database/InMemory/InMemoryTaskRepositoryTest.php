<?php

namespace Unit\Database\InMemory;

use Asapo\Tasks\Database\InMemory\InMemoryTaskRepository;
use Asapo\Tasks\Database\TaskRepositoryInterface;
use Tasks\Scheduler\TaskInterface;

/**
 * @group unit
 */
class InMemoryTaskRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testEmpty()
    {
        $repository = new InMemoryTaskRepository();
        $this->assertEmpty($this->getTasks($repository));

        return $repository;
    }

    /**
     * @depends testEmpty
     */
    public function testPersist(InMemoryTaskRepository $repository)
    {
        $task = $this->prophesize(TaskInterface::class);

        $repository->persist($task->reveal());

        $this->assertCount(1, $this->getTasks($repository));
        $this->assertEquals($task->reveal(), array_values($this->getTasks($repository))[0]->getTask());

        return [$repository, $task];
    }

    /**
     * @depends testPersist
     */
    public function testFindAll($dependsResult)
    {
        /** @var InMemoryTaskRepository $repository */
        /** @var TaskInterface $task */
        list($repository, $task) = $dependsResult;

        $tasks = $repository->findAll();
        $this->assertCount(1, $tasks);
        $this->assertEquals($task->reveal(), $tasks[0]);

        return [$repository, $task];
    }

    /**
     * @depends testPersist
     */
    public function testFindInCompleted($dependsResult)
    {
        /** @var InMemoryTaskRepository $repository */
        /** @var TaskInterface $task */
        list($repository, $task) = $dependsResult;

        $tasks = $repository->findInCompleted();
        $this->assertCount(1, $tasks);
        $this->assertEquals($task->reveal(), $tasks[0]);
    }

    /**
     * @depends testPersist
     */
    public function testMark($dependsResult)
    {
        /** @var InMemoryTaskRepository $repository */
        /** @var TaskInterface $task */
        list($repository, $task) = $dependsResult;

        $repository->markCompleted($task->reveal(), 'result');

        $tasks = $repository->findInCompleted();
        $this->assertEmpty($tasks);

        $tasks = $repository->findAll();
        $this->assertCount(1, $tasks);
    }

    protected function getTasks(TaskRepositoryInterface $repository)
    {
        return $this->getReflectionProperty($repository)->getValue($repository);
    }

    protected function setTasks(TaskRepositoryInterface $repository, $tasks)
    {
        $this->getReflectionProperty($repository)->setValue($repository, $tasks);
    }

    protected function getReflectionProperty(TaskRepositoryInterface $repository)
    {
        $class = new \ReflectionClass($repository);
        $property = $class->getProperty('tasks');
        $property->setAccessible(true);

        return $property;
    }
}
