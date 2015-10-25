<?php

namespace Tasks;

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

    public function getWorkerName()
    {
        return $this->workerName;
    }

    public function getWorkload()
    {
        return $this->workload;
    }
}
