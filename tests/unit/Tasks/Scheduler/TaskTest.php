<?php

namespace Unit\Tasks\Scheduler;

use Tasks\Scheduler\Task;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    public function testGetter()
    {
        $task = new Task('worker-name', 'workload');

        $this->assertEquals('worker-name', $task->getWorkerName());
        $this->assertEquals('workload', $task->getWorkload());
    }
}
