<?php

namespace Tasks\Scheduler;

class Task implements TaskInterface
{
    /**
     * @var string
     */
    private $workerName;

    /**
     * @var string
     */
    private $workload;

    public function __construct($workerName, $workload)
    {
        $this->workerName = $workerName;
        $this->workload = $workload;
    }

    /**
     * {@inheritdoc}
     */
    public function getWorkerName()
    {
        return $this->workerName;
    }

    /**
     * {@inheritdoc}
     */
    public function getWorkload()
    {
        return $this->workload;
    }
}
