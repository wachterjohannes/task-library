<?php

namespace Tasks\Scheduler;

use Serializable;

interface TaskInterface
{
    /**
     * @return string
     */
    public function getWorkerName();

    /**
     * @return string|Serializable
     */
    public function getWorkload();
}
